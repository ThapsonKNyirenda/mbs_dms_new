  <!-- Customers Card -->
  <div class="col-xxl-4 col-md-12" style="width: 100%;">
                <div class="card info-card sales-card" style="width: 100%; ">
  
                  <div class="card-body" style="width: 100%;">
                    <h5 class="card-title p-3">Uploaded Documents</h5>
                    <hr style="margin-bottom: 30px;">
  
                    <div class="table-responsive align-items-center p-2" style="width:100%; overflow-x: auto;" >
                    <table class="table table-striped" id="mytable" >
                        <thead>
                          <tr>
                            <th scope="col">Sr. no</th>
                            <th scope="col">Title</th>
                            <th scope="col">Filename</th>
                            <th scope="col">Folder Path</th>
                            <th scope="col">Time Uploaded</th>
                            <th scope="col">Uploaded By</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                  
                            $sql = "SELECT * FROM finance";
                            $result = $conn->query($sql);

                            
                            
                            if ($result->num_rows > 0) {
                                $count= 1;
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                  echo'
                                      <tr>
                                      <td>'.$count++.'</td>
                                      <td>'.$row["title"].'</td>
                                      <td>'.$row["filename"].'</td>
                                      <td>'.$row["folder_path"].'</td>
                                      <td>'.$row["time_stamp"].'</td>
                                      <td>'.$row["uploaded_by"].'</td>
                                      <td>
                                          <span><a href="uploads/finance/'.$row['filename'].'"><button class="btn btn-danger" id="btn2"><i <i class="bi bi-cloud-arrow-down-fill"></i></i></button></a></span>
                                          <span><a href="#" class="delete-button" data-docid="'.$row['id'].'"><button class="btn btn-danger" id="btn2"><i class="bi bi-trash"></i></button></a></span>
                                      </td>                                          
                                      </tr>
                                  ';
                              }                              
                            } else {
                                echo "";
                            }
                          
                          ?>
                          
                        </tbody>
                      </table>
                        <!-- End Table with stripped rows -->
                      
                    </div>
                  </div>
  
                </div>
              </div><!-- End Sales Card -->
  
        </div><!-- End Left side columns -->          
          
      </div>
    </section>

  </main><!-- End #main -->

  <!-- Copyright © 2021 Malawi Bureau of Standards Designed by Kreative Technologies -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      <span>copyright </span> &copy;&nbsp;  <strong><span>2023 Malawi Bureau of Standards</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <!-- custom script for datatables -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
  <!-- <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> -->
  <!-- <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> -->
  <!-- <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap.min.js"></script> -->
  <script>

    $(document).ready(function() {
        $('#mytable').DataTable();

        $('.delete-button').click(function(event) {
          event.preventDefault(); 
          var docId = $(this).data('docid'); 

          Swal.fire({
            title: 'Are you sure?',
            text: 'Once deleted, you will not be able to recover this file!',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'No, keep it',
            confirmButtonText: 'Yes, delete it!',
            reverseButtons: true,
            confirmButtonColor: '#d33',  // This will set the confirm button to red
            cancelButtonColor: '#3085d6' // This will set the cancel button to default blue
        }).then((result) => {
            if (result.value) {
                window.location.href = "delete_finance.php?doc_id=" + docId;
            }
        });

      });

    });


    // $('#example').DataTable();
    $(document).ready(function() {
        $('#mytable').DataTable();
    });

      // swal({
      //   title: "Are you sure?",
      //   text: "Once deleted, you will not be able to recover this imaginary file!",
      //   icon: "warning",
      //   buttons: true,
      //   dangerMode: true,
      // })
      // .then((willDelete) => {
      //   if (willDelete) {
      //     document.getElementById("link1").href="delete_finance.php?doc_id='. $row['id'].'";
      //     swal("Poof! Your imaginary file has been deleted!", {
      //       icon: "success",
      //     });
      //   } else {
      //     swal("Your imaginary file is safe!");
      //   }
      // });
  </script>
  <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
  <!-- Include SweetAlert2 library via CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>


  <script>
    window.addEventListener("load", function () {
        var load_screen = document.getElementById("loading");
        document.body.removeChild(load_screen);
    });
</script>

</body>

</html>