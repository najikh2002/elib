<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Baca - {{ $judulbuku }}</title>
    {{-- style --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- script --}}
</head>
<body>
    <div class="flex flex-col justify-center items-center p-10 gap-5">
        <div class="flex justify-center items-center pt-[30px]">
            <canvas id="the-canvas" class="w-screen md:max-w-full"></canvas>
        </div>

        {{-- controller --}}
        <div class="fixed top-0 left-0 w-full bg-black text-white p-4 flex justify-between items-center">
            <h1 class="text-lg truncate max-w-[30%] font-semibold">{{ $judulbuku }}</h1>

            <div class="flex items-center justify-center space-x-4">
                <button id="prev" class="focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>

                <span class="text-gray-200">
                    Page: <input type="text" id="page_num" class="font-semibold bg-white text-black w-[30px] text-center" /> of <span id="page_count" class="font-semibold">{{ $countPages }}</span>
                </span>

                <button id="next" class="focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>

            <a href="/home" class="text-white"><i class="fa fa-home" aria-hidden="true"></i></a>
        </div>
    </div>


      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
      <script type="module">
        // If absolute URL from the remote server is provided, configure the CORS
        let pageNumber = 1;
        var maxPages = parseInt("{{$countPages}}");

        // Function to load and render PDF
        function loadAndRenderPdf() {
          var url = `/detail/{{ $kodebuku }}/${pageNumber}/read`;
          document.getElementById('page_num').innerHTML = pageNumber.toString();
          document.getElementById('page_num').value = pageNumber.toString();

          // Loaded via <script> tag, create shortcut to access PDF.js exports.
          var { pdfjsLib } = globalThis;

          // The workerSrc property shall be specified.
          pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

          // Asynchronous download of PDF
          var loadingTask = pdfjsLib.getDocument(url);
          loadingTask.promise.then(function(pdf) {
            console.log('PDF loaded');

            // Fetch the first page
            pdf.getPage(1).then(function(page) {
              console.log('Page loaded');

              var scale = 5.5;
              var viewport = page.getViewport({ scale: scale });

              // Prepare canvas using PDF page dimensions
              var canvas = document.getElementById('the-canvas');
              var context = canvas.getContext('2d');
              canvas.height = viewport.height;
              canvas.width = viewport.width;

              // Render PDF page into canvas context
              var renderContext = {
                canvasContext: context,
                viewport: viewport
              };
              var renderTask = page.render(renderContext);
              renderTask.promise.then(function() {
                console.log('Page rendered');
              });
            });
          }, function(reason) {
            // PDF loading error
            console.error(reason);
          });
        }

        // Event handler for the "#next" button
        $('#next').on("click", function() {
          if(pageNumber < maxPages) {
                pageNumber++;
          } else {
            console.log('Max Pages');
            return pageNumber;
          }
          loadAndRenderPdf(); // Load and render the new PDF when the button is clicked
        });

        // Event handler for the "#prev" button
        $('#prev').on("click", function() {
            if(pageNumber > 1) {
                pageNumber--;
          } else {
            console.log('Min Pages');
            return pageNumber;
          }
          loadAndRenderPdf(); // Load and render the new PDF when the button is clicked
        });

        $('#page_num').on("input", function() {
            var userPage = $('#page_num').val();

            if (userPage >= 1 && userPage <= maxPages) {
                pageNumber = parseInt(userPage);
                loadAndRenderPdf();
            } else if (userPage === "") {
                // Jangan lakukan apa-apa jika input kosong
            } else {
                location.reload(true);
                if (userPage < 0) {
                    userPage = 1;
                } else if (userPage > maxPages) {
                    userPage = maxPages;
                } else {
                    console.log('Invalid Page Number');
                }

                // Setelah menyesuaikan pageNumber, reload halaman
            }
        });

        // Initial load and render
        loadAndRenderPdf();
    </script>
</body>
</html>
