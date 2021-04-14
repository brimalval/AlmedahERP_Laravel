<?php

namespace App\Http\Controllers;

use App\Models\MaterialsOrdered;
use App\Models\MaterialPurchased;
use App\Models\PurchaseReceipt;
use App\Models\Supplier;
use App\Models\SuppliersQuotation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Exception;
use DB;

class PurchaseReceiptController extends Controller
{
    //
    public function index()
    {
        $purchase_receipts = PurchaseReceipt::all();
        return view('modules.buying.purchasereceipt', ['receipts' => $purchase_receipts]);
    }

    public function openReceiptForm()
    {
        $orders = MaterialPurchased::where('mp_status', 'To Receive and Bill')->get();
        return view('modules.buying.newPurchaseReceipt', ['orders' => $orders]);
    }

    public function showReceipt($id)
    {
        $receipt = PurchaseReceipt::find($id);
        $orders = MaterialPurchased::where('mp_status', 'To Receive and Bill')->get();
        $materials = $receipt->receivedMats();
        $mat_purchased = $receipt->order;
        $supplier = $mat_purchased->supplier_quotation->supplier;
        return view('modules.buying.purchasereceiptinfo', ['receipt' => $receipt, 'materials' => $materials, 'orders' => $orders, 'supplier' => $supplier]);
    }

    public function getOrderedMaterials($id)
    {
        try {
            $mat_purchased = MaterialPurchased::find($id);
            $supplier = SuppliersQuotation::where('supp_quotation_id', $mat_purchased->supp_quotation_id)->first()->supplier;
            $ordered_mats = $mat_purchased->itemsPurchased();
            $purchase_id = $mat_purchased->purchase_id;
            return ['ordered_mats' => $ordered_mats, 'purchase_id' => $purchase_id, 'supplier' => $supplier];
        } catch (Exception $e) {
            return $e;
        }
    }

    public function changeStatus($receipt_id)
    {
        try {
            $receipt = PurchaseReceipt::where('p_receipt_id', $receipt_id)->first();

            //$mat_purchased = MaterialPurchased::where('purchase_id', $receipt->purchase_id)->get();
            //$materials_ordered = $mat_purchased->itemsPurchased();
            //$materials_received = $receipt->receivedMats();

            //for($i = 0; $i < sizeof($materials_ordered); $i++) {
            //    $materials_ordered[$i]['qty'] = $materials_ordered[$i]['qty'] - $materials_received[$i]['qty']; 
            //}

            //$mat_purchased->items_list_purchased = json_encode($materials_ordered);
            //$mat_purchased->save();

            $receipt->pr_status = "To Bill";
            $receipt->save();

            $lastMatOrder = MaterialsOrdered::orderby('id', 'desc')->first();
            $nextOrderId = ($lastMatOrder) ? MaterialsOrdered::orderby('id', 'desc')->first()->id + 1 : 1;

            $to_append = 0;
            $digit_flag = 1;
            while ($nextOrderId >= $digit_flag) {
                ++$to_append;
                $digit_flag *= 10;
            }

            $mo_id = "MAT-ORD-" . str_pad($nextOrderId, 4 - $to_append, '0', STR_PAD_LEFT);

            $pending_item_list = array();
            $items = $receipt->receivedMats();
            $i = 0;
            foreach ($items as $item) {
                array_push(
                    $pending_item_list,
                    array(
                        'item_code' => $item['item_code'],
                        'qty_received' => '0',
                    )
                );
            }

            $mat_order = new MaterialsOrdered();
            $mat_order->mat_ordered_id = $mo_id;
            $mat_order->p_receipt_id = $receipt->p_receipt_id;
            $mat_order->items_list_received = json_encode($pending_item_list);
            $mat_order->save();
        } catch (Exception $e) {
            return $e;
        }
    }

    public function getReceivedMats($id)
    {
        try {
            $receipt = PurchaseReceipt::find($id);
            $receipt_id = $receipt->p_receipt_id;
            $supplier = $receipt->order->supplier_quotation->supplier;
            //$mat_purchased = MaterialPurchased::where('purchase_id', $receipt->purchase_id)->first();
            //$supp_quotation = SuppliersQuotation::where('supp_quotation_id', $mat_purchased->supp_quotation_id)->first();
            //$supplier = Supplier::where('supplier_id', $supp_quotation->supplier_id)->first();
            $received_mats = $receipt->receivedMats();
            return ['p_receipt_id' => $receipt_id, 'received_mats' => $received_mats, 'supplier' => $supplier];
        } catch (Exception $e) {
            return $e;
        }
    }

    public function addReceivedMats(Request $request)
    {
        try {
            $form_data = $request->input();

            $receipt_id = $form_data['receipt_id'];
            $received_mats = $form_data['mat_received'];

            while (gettype($received_mats) === "string") {
                $received_mats = json_decode($received_mats, true);
            }

            $receipt = PurchaseReceipt::where('p_receipt_id', $receipt_id)->first();
            $receipt_mats = $receipt->item_list_received;

            while (gettype($receipt_mats) === "string") {
                $receipt_mats = json_decode($receipt_mats, true);
            }

            $i = 1;

            foreach ($receipt_mats as $key => $mat) {
                $receipt_mats[$key]['qty_received'] = strval(intval($receipt_mats[$key]['qty_received']) - intval($received_mats[$i]['qty_received']));
                $i++;
            }

            //dd($receipt_mats);

            $receipt->item_list_received = json_encode($receipt_mats);
            //echo $receipt->item_list_received;
            $receipt->save();

            $i = 1;

            $pending_order = $receipt->order_record;
            $order_items = $pending_order->items_list_received;
            while (gettype($order_items) === "string") {
                $order_items = json_decode($order_items, true);
            }
            foreach ($order_items as $index => $order_item) {
                $order_items[$index]['qty_received'] = strval(intval($order_items[$index]['qty_received']) + intval($received_mats[$i]['qty_received']));
                //'curr_progress' => intval(($items[$i]['qty_received']/$item['qty'])*100)
                $i++;
            }
            //dd($order_items);
            $pending_order->items_list_received = json_encode($order_items);
            $pending_order->save();
        } catch (Exception $e) {
            return $e;
        }
    }

    public function createReceipt(Request $request)
    {
        try {
            $form_data = $request->input();

            $data = new PurchaseReceipt();

            $lastReceipt = PurchaseReceipt::orderby('id', 'desc')->first();
            $nextId = ($lastReceipt) ? PurchaseReceipt::orderby('id', 'desc')->first()->id + 1 : 1;
            //$nextId = MaterialPurchased::orderby('id', 'desc')->first()->id + $to_add;

            $to_append = 0;
            $digit_flag = 1;
            while ($nextId >= $digit_flag) {
                ++$to_append;
                $digit_flag *= 10;
            }

            $receipt_id = "PR-" . str_pad($nextId, 4 - $to_append, '0', STR_PAD_LEFT);

            $data->p_receipt_id = $receipt_id;
            $data->date_created = $form_data['date_created'];
            $data->purchase_id = $form_data['purchase_id'];
            $data->item_list_received = json_encode($form_data['items_received']);
            $data->grand_total = $form_data['grand_total'];

            $data->save();
        } catch (Exception $e) {
            return $e;
        }
    }

    public function updateReceipt(Request $request)
    {
        try {
            $form_data = $request->input();

            $data = PurchaseReceipt::where('p_receipt_id', $form_data['receipt_id'])->first();

            $data->date_created = $form_data['date_created'];
            $data->purchase_id = $form_data['purchase_id'];
            $data->item_list_received = json_encode($form_data['items_received']);
            $data->grand_total = $form_data['grand_total'];

            $data->save();
        } catch (Exception $e) {
            return $e;
        }
    }
}
