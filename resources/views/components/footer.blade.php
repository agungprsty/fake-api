<footer class="py-5 bg-gradient">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="#docs-swagger" target="_blank">API Docs</a></li>
                    <li class="list-inline-item"><a href="https://github.com/agungprsty/fake-api/" target="_blank">Fork JSONFaker on GitHub</a></li>
                </ul>
            </div>
        </div>
        <div class="row my-2">
            <div class="col-md-12 mx-auto text-muted text-center small-xl" id="copyright">
            </div>
        </div>
    </div>
</footer>

@push('script')
<script>
    const paragraph = `
        <p class="text-muted">
            Inspired by: <a href="https://jsonplaceholder.typicode.com/" target="_blank"><span class="text-secondary">jsonplaceholder</span></a> <br> Copyright &copy; ${new Date().getFullYear()} JSONFaker - All Rights Reserved
        </p>
        `;
    document.getElementById('copyright').innerHTML = paragraph;   
</script>
@endpush