<div id="chart_div"></div>

<script>
  google.charts.load('current', {
    'packages': ['gantt']
  });
  google.charts.setOnLoadCallback(drawChart);

  function toMilliseconds(minutes) {
    return minutes * 60 * 1000;
  }

  function drawChart() {

    var otherData = new google.visualization.DataTable();
    otherData.addColumn('string', 'Task ID');
    otherData.addColumn('string', 'Task Name');
    otherData.addColumn('string', 'Resource');
    otherData.addColumn('date', 'Start');
    otherData.addColumn('date', 'End');
    otherData.addColumn('number', 'Duration');
    otherData.addColumn('number', 'Percent Complete');
    otherData.addColumn('string', 'Dependencies');

    otherData.addRows([
      ['toTrain', 'step1', 'step1', null, null, toMilliseconds(5), 100, null],
      ['music', 'step2', 'step2', null, null, toMilliseconds(70), 100, null],
      ['wait', 'step3', 'step3', null, null, toMilliseconds(10), 100, 'toTrain'],
      ['train', 'step4', 'step4', null, null, toMilliseconds(45), 75, 'wait'],
      ['toWork', 'step5', 'step5', null, null, toMilliseconds(10), 0, 'train'],
      ['work', 'step6', null, null, null, toMilliseconds(2), 0, 'toWork'],

    ]);

    var options = {
      height: 275,
      gantt: {
        defaultStartDateMillis: new Date(2015, 3, 28)
      }
    };

    var chart = new google.visualization.Gantt(document.getElementById('chart_div'));

    chart.draw(otherData, options);
  }
</script>