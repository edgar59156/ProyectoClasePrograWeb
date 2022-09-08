<h1>Bienvenido al sistema</h1>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Panelistas</th>
      <th scope="col">Moderadores</th>
      <th scope="col">Ponentes</th>
      <th scope="col">Conferencias</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><?php echo $participante['panelista']; ?></td>
      <td><?php echo $participante['moderador']; ?></td>
      <td><?php echo $participante['ponente']; ?></td>
      <td><?php echo $participante['conferencias']; ?></td>
    </tr>
  </tbody>

</table>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {
    'packages': ['corechart']
  });
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['Task', 'Hours per Day'],
      ['Ponentes', <?php echo $participante['ponente']; ?>],
      ['Panelistas', <?php echo $participante['panelista']; ?>],
      ['Moderadores', <?php echo $participante['moderador']; ?>],
      ['Conferencias', <?php echo $participante['conferencias']; ?>]
    ]);

    var options = {
      title: 'Resumen'
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

    chart.draw(data, options);
  }
</script>

  <div id="piechart" style="width: 900px; height: 500px;"></div>
