<!--When to use section-->
<section class="py-5">
    <div class="container">
        <h2 class="text-center">When to use</h2>
        <p class="lead mb-2 text-center">JSONFaker is a free online REST API that you can use whenever you need some fake data. It can be in a README on GitHub, for a demo on CodeSandbox, in code examples on Stack Overflow, ...or simply to test things locally.</p>
    </div>
</section>

<!--Resources section-->
<section class="pt-2 pb-4">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-6 mx-auto">
                <h2 class="text-center">Resources</h2>
                <p class="lead mb-2">JSONFaker comes with a set of 4 common resources:</p>
                <div class="container py-3">
                    <table>
                        <caption hidden>List resources</caption>
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="api/users"><span class="text-success">/users</span></a></td>
                                <td>&emsp;10 users <em>(protected)</em></td>
                            </tr>
                            <tr>
                                <td><a href="api/posts"><span class="text-success">/posts</span></a></td>
                                <td>&emsp;100 posts</td>
                            </tr>
                            <tr>
                                <td><a href="api/todos"><span class="text-success">/todos</span></a></td>
                                <td>&emsp;200 todos</td>
                            </tr>
                            <tr>
                                <td><a href="api/comments"><span class="text-success">/comments</span></a></td>
                                <td>&emsp;500 comments</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6 mx-auto">
                <h2 class="text-center">Routes</h2>
                <p class="lead mb-2">All HTTP methods are supported. Use https for your requests.</p>
                <div class="container py-3">
                    <table>
                        <caption hidden>List resources</caption>
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="text-secondary">GET</span></td>
                                <td>&emsp;<a href="api/posts"><span class="text-success">/posts</span></a></td>
                            </tr>
                            <tr>
                                <td><span class="text-secondary">POST</span></td>
                                <td>&emsp;<span class="text-success">/posts</span></td>
                            </tr>
                            <tr>
                                <td><span class="text-secondary">PUT</span></td>
                                <td>&emsp;<span class="text-success">/posts/1</span></td>
                            </tr>
                            <tr>
                                <td><span class="text-secondary">DELETE</span></td>
                                <td>&emsp;<span class="text-success">/posts/1</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <p class="lead text-center">
            <strong>Notes</strong>
            <br> - If routes is protected, so do you login using <em>email: <span class="text-secondary">ujang@example.com</span></em>, <em>password: <span class="text-secondary">rahasia1234</span></em>,
            <br> - Resources have relations. For example: posts have many comments, ... see <a href="{{URL::to("/apidocs")}}" class="text-secondary" target="_blank">guide</a> for the full list.
        </p>
    </div>
</section>

