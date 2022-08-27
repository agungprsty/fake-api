<section class="bg-gradient pt-5 pb-6">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex flex-row align-items-center justify-content-between">
                <div class="heading-brand">JSONFaker</div>
                <a href="#docs-swagger" class="btn btn-outline-dark" target="_blank">DOCUMENTATION</a>
            </div>
        </div>
        <div class="row mt-6">
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
                    <pre class="language-javascript line-numbers"><code class="language-javascript">fetch('https://json-faker.herokuapp.com/api/posts/1')
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
        <div class="mt-3 text-center" id="congrats">
            <p class="lead">Congrats you've made your first call to JSONFaker! 😃 🎉</p>
        </div>
    </div>
</section>

@push('script')
<script>
    const url = "api/posts/1";
    const btn_run = "#run";
    const result = "#result";
    const congrats = "#congrats";
    const format_space = "&emsp;&emsp;&emsp;";
    
    $(document).ready(function() {
        $(congrats).attr("hidden", "true")
        $(btn_run).click( function() {
            $.ajax({
                url: url,
                success: function(data){
                    replace_respon(data.data)
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
    "title": ${params.title.slice(0, 40) + (params.title.length > 40 ? "..." : "")},
    "body": ${params.body.replace(/\n/g, `<br>${format_space}`)},
}</code></pre>
        `);
        $(congrats).removeAttr("hidden", "true")
    }
</script>
@endpush