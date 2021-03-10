<script>
    window.onload = function() {

        var dataPoints = [];

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2",
            zoomEnabled: true,
            title: {
                text: "Bitcoin Price - 2017"
            },
            axisY: {
                title: "Price in USD",
                titleFontSize: 24,
                prefix: "$"
            },
            data: [{
                type: "line",
                yValueFormatString: "$#,##0.00",
                dataPoints: dataPoints
            }]
        });

        function addData(data) {
            var dps = data.price_usd;
            for (var i = 0; i < dps.length; i++) {
                dataPoints.push({
                    x: new Date(dps[i][0]),
                    y: dps[i][1]
                });
            }
            chart.render();
        }

        $.getJSON("https://canvasjs.com/data/gallery/php/bitcoin-price.json", addData);

    }
</script>
<div class="row body-dashboard">
    <div class="col-7">
        <div class="row">
            <div class="col">
                <div class="card text-white bg-success mb-3 shadow-card" style="max-width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">$<span class="float-right">0</span></h5>
                        <p class="card-text">Money Money</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-primary mb-3 shadow-card" style="max-width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">$<span class="float-right">1.7M</span></h5>
                        <p class="card-text">Money Money</p>
                    </div>
                </div>
                <div class="card text-white bg-dark mb-3 shadow-card" style="max-width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title"><span class="fa fa-angle-left"></span><span class="fa fa-angle-right"></span><span class="float-right">4.431M</span></h5>
                        <p class="card-text">Contents.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-primary mb-3 shadow-card" style="max-width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title"><span class="fa fa-cog"></span><span class="float-right">1,736</span></h5>
                        <p class="card-text">content.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <img src="images/graph.png" class="img-fluid" alt="...">
    </div>
</div>
<br><br>
<div class="row body-dashboard">
    <div class="col-7">
        <div class="row">
            <div class="col">
                <div class="card text-white bg-danger mb-3 shadow-card" style="max-width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title"><span class="fas fa-redo"></span><span class="float-right">22</span></h5>
                        <p class="card-text">More Content</p>
                    </div>
                </div>
                <div class="card text-white bg-danger mb-3 shadow-card" style="max-width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title"><span class="fas fa-clipboard"></span><span class="float-right">3</span></h5>
                        <p class="card-text">More and More</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-success mb-3 shadow-card" style="max-width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title"><span class="fas fa-phone"></span><span class="float-right">1</span></h5>
                        <p class="card-text">Wow Content</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-success mb-3 shadow-card" style="max-width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title"><span class="fas fa-phone"></span><span class="float-right">1</span></h5>
                        <p class="card-text">this Numbers</p>
                    </div>
                </div>
                <div class="card text-white bg-success mb-3 shadow-card" style="max-width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title"><span class="fas fa-phone"></span><span class="float-right">0</span></h5>
                        <p class="card-text">Some more</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <img src="images/bar.png" class="img-fluid" alt="...">
    </div>
</div>