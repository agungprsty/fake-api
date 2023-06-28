<section class="bg-gradient pt-3 pb-3" style="height: 100vh">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex flex-row align-items-center justify-content-between">
                <div class="heading-brand">JSONFaker</div>
                <a href="{{URL::to("/apidocs")}}" class="btn btn-outline-dark" target="_blank">DOCUMENTATION</a>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-8 mx-auto text-center">
                <h1>Free Fake REST API</h1>
                <p class="lead mb-2">JSONFaker is a service that provides free REST API, with this you can easily do testing and prototyping.</p>
            </div>
        </div>
        <div class="mt-5 mx-auto text-center">
            <h2>Let's go try it</h2>
        </div>
        <div class="row mt-3">
            <div class="col-md-9 mx-auto">
                <p class="lead mb-2 text-center">Run this code here, in a console or from any site.</p>
                <div class="code-window">
                    <div class="dots">
                        <div class="red"></div>
                        <div class="orange"></div>
                        <div class="green"></div>
                    </div>
                    <pre class="language-javascript line-numbers"><code class="language-javascript">fetch('https://json-faker.vercel.com/api/posts/1')
    .then(response => response.json())
    .then(json => console.log(json))</code></pre>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-9 mx-auto">
                <button type="button" id="run" class="btn btn-outline-success">Run Script</button>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-9 mx-auto">
                <div class="code-window">
                    <div class="dots">
                        <div class="red"></div>
                        <div class="orange"></div>
                        <div class="green"></div>
                    </div>
                    <pre class="language-javascript line-numbers" id="result"><code class="language-javascript">{
    // Result
}</code></pre>
                </div>
            </div>
        </div>
        <div></div>
    </div>
</section>

@push('script')
<script>
    const url = "api/posts/1";
    const btn_run = "#run";
    const result = "#result";
    const congrats = "#congrats";

    $(document).ready(function() {
        $(btn_run).click( function() {
            $.ajax({
                url: url,
                success: function(data){
                    replace_respon(data.data);
                    showToast("Congrats!", "You've made your first call to JSONFaker!");
                },
                error: function(){
                    alert("There was an error.");
                }
            });
        });
    });

    function replace_respon(params) {
        $(result).replaceWith(`
        <pre class="language-javascript line-numbers" id="result"><code class="language-javascript">{
    "id": ${params.id},
    "uid": ${params.uid},
    "title": ${params.title.slice(0, 50) + (params.title.length > 50 ? "..." : "")},
    "body": ${params.body.slice(0, 50) + (params.body.length > 50 ? "..." : "")},
}</code></pre>
        `);
    };

    function showToast(title, msg) {
        // Membuat elemen toast baru
        const toast = document.createElement('div');
        toast.classList.add('toast');
        toast.classList.add('top-right');

        // Membuat elemen judul toast
        const toastTitle = document.createElement('div');
        toastTitle.classList.add('toast-title');
        toastTitle.textContent = title;

        // Membuat elemen pesan toast
        const toastMessage = document.createElement('div');
        toastMessage.classList.add('toast-message');
        toastMessage.textContent = msg;

        // Menggabungkan elemen judul dan pesan dalam toast
        toast.appendChild(toastTitle);
        toast.appendChild(toastMessage);

        // Menambahkan toast ke dalam body
        document.body.appendChild(toast);

        // Menghapus toast setelah 3 detik
        setTimeout(function() {
            toast.classList.add('hide');
            setTimeout(function() {
            document.body.removeChild(toast);
            }, 300);
        }, 3000);
    }
</script>
@endpush
