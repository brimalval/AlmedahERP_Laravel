<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class ChartModel extends Model
{
    public static function get_chart_data($date = '', $filter_type = '') {
        
        $result['Pending'] = [];

        $query  = "
            SELECT
                count(id) AS count,
        ";

        if ($filter_type == 'yearly') {

            $query .= "DATE_FORMAT(real_start_date,'%Y-%m') AS date";
        }
        else if($filter_type == 'monthly'){
            $query .= "DATE_FORMAT(real_start_date,'%Y-%m-%d') AS date";
        }

        $query  .= "
            FROM
                work_order
            
            WHERE
                work_order_status = 'Pending'   
        ";

        if ($filter_type == 'yearly') {
            $query .= "
                AND DATE_FORMAT(real_start_date,'%Y') = ?
                
            GROUP BY
                DATE_FORMAT(real_start_date,'%Y-%m')
            ";
            $result['Pending']      = DB::select($query,[$date]);
        }
        else if($filter_type == 'monthly'){
            $query .= "
                AND DATE_FORMAT(real_start_date,'%Y-%m') = ?
                
            GROUP BY
                DATE_FORMAT(real_start_date,'%Y-%m-%d')
            ";
            $result['Pending']      = DB::select($query,[$date]);
        }


        
        $result['Completed'] = [];

        $query  = "
            SELECT
                count(id) AS count,
        ";

        if ($filter_type == 'yearly') {

            $query .= "DATE_FORMAT(real_start_date,'%Y-%m') AS date";
        }
        else if($filter_type == 'monthly'){
            $query .= "DATE_FORMAT(real_start_date,'%Y-%m-%d') AS date";
        }

        $query  .= "
            FROM
                work_order
            
            WHERE
                work_order_status = 'Completed'   
        ";

        if ($filter_type == 'yearly') {
            $query .= "
                AND DATE_FORMAT(real_start_date,'%Y') = ?
                
            GROUP BY
                DATE_FORMAT(real_start_date,'%Y-%m')
            ";
            $result['Completed']      = DB::select($query,[$date]);
        }
        else if($filter_type == 'monthly'){
            $query .= "
                AND DATE_FORMAT(real_start_date,'%Y-%m') = ?
                
            GROUP BY
                DATE_FORMAT(real_start_date,'%Y-%m-%d')
            ";
            $result['Completed']      = DB::select($query,[$date]);
        }

        return !empty($result) ? json_decode(json_encode($result), true) : [];
    }

    public static function get_table_data($date = '', $filter_type = '') {
        $query  = "
            SELECT 
                id,
                planned_start_date,
                planned_end_date,
                real_start_date,
                real_end_date,
                work_order_status
            
            FROM 
                work_order
        ";

        if($filter_type == 'yearly'){
            $query .= " WHERE DATE_FORMAT(real_start_date,'%Y') = ?";
        }
        else if ($filter_type == 'monthly'){
            $query .= " WHERE DATE_FORMAT(real_start_date,'%Y-%m') = ?";
        }


        $result = DB::select($query,[$date]);

        return !empty($result) ? json_decode(json_encode($result), true) : [];
    }

    public static function get_sales_data($date = '', $filter_type = '') {
        $query  = "
            SELECT 
                COUNT(id) AS total_count,
                sales_status
            
            FROM 
                salesorder

        ";

        if($filter_type == 'yearly'){
            $query .= " WHERE DATE_FORMAT(transaction_date,'%Y') = ?";
        }
        else if ($filter_type == 'monthly'){
            $query .= " WHERE DATE_FORMAT(transaction_date,'%Y-%m') = ?";
        }

        $query .=
        " 
            GROUP BY 
                sales_status
        ";

        $result = DB::select($query,[$date]);

        return !empty($result) ? json_decode(json_encode($result), true) : [];
    }

    public static function get_ordered_data($filter = []) {
        $query  = "
            SELECT 
                id,
                quantity_purchased
            
            FROM 
                ordered_products
         
        ";

        $result = DB::select($query);

        return !empty($result) ? json_decode(json_encode($result), true) : [];
    }

    public static function get_sales_table_data($date = '', $filter_type = '') {
        $query  = "
        SELECT 
            so.id,
            so.customer_id,
            so.cost_price,
            so.transaction_date,
            so.payment_balance,
            so.sales_status,
            so.installment_type,
            CASE
                WHEN payment_mode = 'Cash' THEN null
                WHEN payment_mode = 'Installment' THEN 
                    DATE_ADD(transaction_date, INTERVAL installment_type MONTH)
            END AS due_date
    
        FROM 
            salesorder AS so
            
        LEFT JOIN
            payment_logs AS pl
            
        ON
			pl.sales_id = so.id
            
		

            
        ";

        if($filter_type == 'yearly'){
            $query .= " WHERE DATE_FORMAT(transaction_date,'%Y') = ?";
        }
        else if ($filter_type == 'monthly'){
            $query .= " WHERE DATE_FORMAT(transaction_date,'%Y-%m') = ?";
        }


        $result = DB::select($query,[$date]);

        return !empty($result) ? json_decode(json_encode($result), true) : [];
    }

    public static function get_sales_order_data($type= '', $date_from = '', $date_to = '') {
        

        if ($type == 'yearly') {

            $query = "
                SELECT
                    SUM(cost_price) AS amount,
                    DATE_FORMAT(transaction_date,'%Y-%m') AS date
            ";
        }
        else{
            $query = "
                SELECT
                    SUM(cost_price) AS amount,
                    transaction_date AS date
            ";
        }

            $query  .= "
                FROM	
                    salesorder
                WHERE
                    sales_status = 'Fully Paid'
            ";

            if ($date_from != '' && $date_to != '') {
                $query .= "
                    AND
                        transaction_date BETWEEN ? AND ?
                ";
            }

        if ($type == 'yearly') {

            $query .= "
                GROUP BY
                    DATE_FORMAT(transaction_date,'%Y-%m')
            ";
        }
        else{
            $query .= "
                GROUP BY
                    transaction_date
            ";
        }

        // dd($query);
        if ($date_from != '' && $date_to != '') {
            $fully_paid = DB::select($query,[$date_from,$date_to]);
        }
        else {
        
            $fully_paid = DB::select($query);
        }

        $fully_paid = !empty($fully_paid) ? array_column($fully_paid,'amount','date') : [];
        return $fully_paid;
        // $query  = "
        //     SELECT
        //         sum(cost_price) AS amount,
        //         DATE_FORMAT(transaction_date,'%Y-%m') AS date
        //     FROM	
        //         salesorder
        //     /*WHERE
        //         sales_status = 'With Outstanding Balance'*/
        //     GROUP BY
        //         DATE_FORMAT(transaction_date,'%Y-%m')
         
        // ";

        // $without = DB::select($query);
        // $without = !empty($without) ? array_column($without,'amount','date') : [];

        // return array_merge_recursive($fully_paid,$without);
    }

    public static function get_sales_trends_table($date = '', $filter_type = '') {
        $query  = "
        SELECT 
            so.id AS sales_id,
            so.customer_id,
            so.transaction_date,
            so.cost_price,
            op.quantity_purchased,
            op.product_code
            
            
        FROM
            salesorder AS so
            
        LEFT JOIN
            payment_logs AS pl 
        ON
            pl.sales_id = so.id 
                
            
        LEFT JOIN
            man_customers AS mc 
        ON
            mc.id = so.customer_id 
                
        LEFT JOIN
            ordered_products AS op
        ON
            op.sales_id = so.id 
                
        LEFT JOIN
            man_products AS poo
        ON
            poo.product_code = op.product_code
        ";

        if($filter_type == 'yearly'){
            $query .= " WHERE DATE_FORMAT(transaction_date,'%Y') = ?";
        }
        else if ($filter_type == 'monthly'){
            $query .= " WHERE DATE_FORMAT(transaction_date,'%Y-%m') = ?";
        }
        
        $result = DB::select($query,[$date]);

        return !empty($result) ? json_decode(json_encode($result), true) : [];
    }

    public static function get_delivery_data($date = '', $filter_type = '' ){
       $query ="
            SELECT 
            COUNT(so.id) AS total_count,
            de.delivery_status
        
            FROM
                salesorder AS so 
            
            LEFT JOIN
                work_order AS wo
            on 
                so.id = wo.sales_id
            
            LEFT JOIN
                delivery as de
            on
                so.id = de.sales_id
       ";
        
        if($filter_type == 'yearly'){
            $query .= " WHERE DATE_FORMAT(real_end_date,'%Y') = ? 
            OR
            delivery_status = 'Shipped' " ;
        }
        else if ($filter_type == 'monthly'){
            $query .= " WHERE DATE_FORMAT(real_end_date,'%Y-%m') = ?
            OR
            delivery_status = 'Shipped' ";
        }

        $query .= " 
            GROUP BY 
                delivery_status
        ";

        
        
        if(!empty($filter_type)){
            $result = DB::select($query,[$date]);
        }
        else{
            $result = DB::select($query);
        }

        
        return !empty($result) ? json_decode(json_encode($result), true) : [];

    }

    public static function get_delivery_table_data($date = '', $filter_type = '' ){
        $query= "
            SELECT 
                mc.id,
                de.sales_id,
                wo.real_end_date,
                so.sales_status,
                de.date_received,
                de.delivery_status,
                CASE
                    WHEN delivery_status = 'to ship' & 'Shipped' &'Received' THEN
                        DATE_ADD(real_end_date, INTERVAL 7 DAY)
                END AS due_date
            
            FROM 
                salesorder AS so 

            LEFT JOIN
                delivery AS de
            ON
                so.id = de.sales_id
                
            LEFT JOIN
                man_customers AS mc
            ON
                mc.id = so.customer_id	
                
            LEFT JOIN
                work_order AS wo
            ON
                so.id = wo.sales_id
                
            LEFT JOIN
                payment_logs AS pl
            ON
                so.id = pl.sales_id
                    
            
        ";
        
        if($filter_type == 'yearly'){
            $query .= " WHERE DATE_FORMAT(real_end_date,'%Y') = ?";
        }
        else if ($filter_type == 'monthly'){
            $query .= " WHERE DATE_FORMAT(real_end_date,'%Y-%m') = ?";
        }


        $result = DB::select($query,[$date]);

        return !empty($result) ? json_decode(json_encode($result), true) : [];

    }

    public static function get_fast_moving_data($date = '', $filter_type = '' ){
        $query ="
        
        SELECT 
           COUNT(op.quantity_purchased) AS product_count,
            mnp.product_name
        
        FROM
            salesorder AS so 
        
        LEFT JOIN
            ordered_products AS op
        ON
            so.id = op.sales_id
        
        LEFT JOIN
            man_products AS mnp
        ON
            op.product_code = mnp.product_code
        ";
            

        if($filter_type == 'yearly'){
            $query .= " WHERE DATE_FORMAT(transaction_date,'%Y') = ?";
        }
        else if ($filter_type == 'monthly'){
            $query .= " WHERE DATE_FORMAT(transaction_date,'%Y-%m') = ?";
        }
        	
        $query .="    
        GROUP BY 
            product_name ASC
        ORDER BY
            product_count DESC
        ";


        
        $result = DB::select($query,[$date]);

        return !empty($result) ? json_decode(json_encode($result), true) : [];

    }


    public static function get_fast_moving_table($date = '', $filter_type = '' ){
        $query ="
        select
            mnp.product_name,
            mnp.sales_price_wt,
            COUNT(op.quantity_purchased) as quantity_purchased,
            mnp.sales_price_wt * COUNT(op.quantity_purchased) AS total_sales
    
        FROM
            salesorder AS so
            
        LEFT JOIN
            ordered_products AS op
        ON
            so.id = op.sales_id
            
        LEFT JOIN
            man_products AS mnp
        ON
            mnp.product_code = op.product_code
        ";
            

        if($filter_type == 'yearly'){
            $query .= " WHERE DATE_FORMAT(transaction_date,'%Y') = ?";
        }
        else if ($filter_type == 'monthly'){
            $query .= " WHERE DATE_FORMAT(transaction_date,'%Y-%m') = ?";
        }
        	
        $query .="    
        GROUP BY 
            product_name ASC
        ";


        
        $result = DB::select($query,[$date]);

        return !empty($result) ? json_decode(json_encode($result), true) : [];

    }

    
}
?>