<!DOCTYPE html>
<html>

<head>
  <title>Scoreboard</title>
  <style>
    table {
      border-spacing: 0;
      width: 100%;
      border: 1px solid #ddd;
    }

    th {
      cursor: pointer;
    }

    th,
    td {
      text-align: left;
      padding: 16px;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2
    }
  </style>
</head>

<body>
  <h1> Scoreboard </h1>
  This is a sortable scoreboard table. To sort click the table heading that you wanna sort by.
  <br><br>
  <?php
  session_start();
  if (!isset($_SESSION["username"]))
    header("Location: /login");

  $url = 'http://localhost/scoreboard/api/user/get_scoreboard.php';
  $data = file_get_contents($url);
  $fullscoreboard = json_decode($data);
  $userscores = $fullscoreboard->scoreboard;
  $user=$_SESSION["username"];
  echo "welcome to the scoreboard  <b>" . $user . "</b><br><br>";

  if (isset($_GET['func'])) {
    $func = $_GET['func'];
    if ($func == "update")
      header("Location: /scoreupdate");
    elseif ($func == "logout") {
      session_destroy();
      header("Location: /login");
    }
  }
  ?>
  <table id="myTable">
    <tr>
      <th onclick="sortTable(0)">User</th>
      <th onclick="sortTable(1)">Score</th>
    </tr>
    <?php foreach ($userscores as $userscore) : ?>
      <tr>
        <td> <?php echo ($userscore->username==$user)? "-> ".$user : $userscore->username; ?> </td>
        <td> <?php echo $userscore->score; ?> </td>
      </tr>
    <?php endforeach; ?>
  </table>
  <a href="?func=update">Update your score</a>
  <br>
  <a style="color:red" href="?func=logout">logout</a>

  <script>
    function sortTable(n) {
      var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
      table = document.getElementById("myTable");
      switching = true;
      dir = "asc";
      while (switching) {
        switching = false;
        rows = table.rows;

        for (i = 1; i < (rows.length - 1); i++) {
          shouldSwitch = false;

          x = rows[i].getElementsByTagName("TD")[n];
          y = rows[i + 1].getElementsByTagName("TD")[n];

          if (dir == "asc") {
            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
              shouldSwitch = true;
              break;
            }
          } else if (dir == "desc") {
            if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
              shouldSwitch = true;
              break;
            }
          }
        }
        if (shouldSwitch) {
          rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
          switching = true;
          switchcount++;
        } else {
          if (switchcount == 0 && dir == "asc") {
            dir = "desc";
            switching = true;
          }
        }
      }
    }
  </script>

</body>

</html>