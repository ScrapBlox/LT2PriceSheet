function myFunction() {
  var input, filter, table, tr, td, i, j, txtValue, rowMatches;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, skipping the first row (headers)
  for (i = 1; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td");
      rowMatches = false;

      // Check each cell in the current row
      for (j = 0; j < td.length; j++) {
          if (td[j]) {
              txtValue = td[j].textContent || td[j].innerText;
              if (txtValue.toUpperCase().indexOf(filter) > -1) {
                  rowMatches = true; // Match found in this row
                  break;
              }
          }
      }

      // Show/hide the row based on whether it matches the filter
      if (rowMatches) {
          tr[i].style.display = "";
      } else {
          tr[i].style.display = "none";
      }
  }
}
