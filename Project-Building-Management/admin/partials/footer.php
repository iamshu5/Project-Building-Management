                </div>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white mt-5">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>&copy; 2021 PT. DewanStudio Media Digital</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <div class="modal fade" id="modal-image-detail" tabindex="-1" aria-labelledby="modal-image-detail-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-image-detail-label">Detail Gambar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center table-responsive">
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= URL_WEB ?>assets/js/jquery.min.js"></script>
    <script src="<?= URL_WEB ?>assets/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= URL_WEB ?>assets/js/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= URL_WEB ?>assets/js/sb-admin-2.min.js"></script>

    <script src="<?= URL_WEB ?>assets/js/jquery.dataTables.min.js"></script>
    <script src="<?= URL_WEB ?>assets/js/dataTables.bootstrap4.min.js"></script>

    <script>
        const BASE_URL = '<?= URL_WEB ?>';

        function fixNumClock(num) {
            return num < 10 ? '0' + num : num;
        }

        function monthNumToString(num) {
            switch (num) {
                case 1:
                    return 'Januari';
                case 2:
                    return 'Februari';
                case 3:
                    return 'Maret';
                case 4:
                    return 'April';
                case 5:
                    return 'Mei';
                case 6:
                    return 'Juni';
                case 7:
                    return 'Juli';
                case 8:
                    return 'Agustus';
                case 9:
                    return 'September';
                case 10:
                    return 'Oktober';
                case 11:
                    return 'November';
                case 12:
                    return 'Desember';
            }
        }

        function initClock() {
            setInterval( () => {
                const dateInstance = new Date();
                const year = dateInstance.getFullYear();
                const month = monthNumToString( (dateInstance.getMonth() < 11 ? dateInstance.getMonth() + 1 : dateInstance.getMonth()) );
                const date = fixNumClock(dateInstance.getDate());
                const hours = fixNumClock(dateInstance.getHours());
                const minutes = fixNumClock(dateInstance.getMinutes());
                const seconds = fixNumClock(dateInstance.getSeconds());

                const currentDatetime = `${date} ${month} ${year} ${hours}:${minutes}:${seconds} WIB`;
                $('#clock-realtime').html(currentDatetime);
            }, 1000);
        }

        function imageDetail(imgUrl, height = 300) {
            $('#modal-image-detail .modal-body').html('');
            $('#modal-image-detail .modal-body').append(`<img id="image-detail" src="" height="">`);
            $('#modal-image-detail #image-detail').attr('src', BASE_URL + 'assets/img/' + imgUrl);
            $('#modal-image-detail #image-detail').attr('height', height + 'px');

            $('#modal-image-detail').modal('show');
        }

        function fotoLaporan(idLaporan) {
            $.ajax({
                url: BASE_URL + 'admin/ajax/foto-laporan.php',
                method: 'POST',
                dataType: 'json',
                data: { id_laporan: idLaporan },

                error: function(jqXHR, errorStatus, err) {
                    console.error(err);
                },
                success: function(response) {
                    $('#modal-image-detail .modal-body').html('');
                    response.forEach( function(value, index) {
                        const margin = index + 1 < response.length ? 'mb-3' : '';
                        $('#modal-image-detail .modal-body').append(`<img id="image-detail-${index}" class="d-block mx-auto ${margin}" src="${ BASE_URL + 'assets/img/laporan/' + value }" height="350px">`);
                    });

                    $('#modal-image-detail').modal('show'); 
                }
            });
        }

        function hapusData(urlDelete, page) {
            const yes = confirm(`Apakah anda yakin, ingin menghapus data ${ page }?`);
            if( yes ) {
                location.href = BASE_URL + 'admin/'  + urlDelete;
            }
        }

        $(document).ready(function() {
            initClock();

            $('[id*=datatable]').DataTable({
                order: [0, 'desc']
            });
        });
    </script>