<div class="container-fluid">
    <div class="row text-muted">
        <div class="col-6 text-start">
            <p class="mb-0">
                <a class="text-muted" href="https://adminkit.io/"
                    target="_blank"><strong>AdminKit</strong></a> &copy;
            </p>
        </div>
        <div class="col-6 text-end">
            <ul class="list-inline">
                <li class="list-inline-item">
                    <form method="GET" action="{{ route('register') }}">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </li>
                <li class="list-inline-item">
                <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
                </li>
                <li class="list-inline-item">
                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Support</a>
                </li>
                <li class="list-inline-item">
                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Help Center</a>
                </li>
                <li class="list-inline-item">
                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Privacy</a>
                </li>
                <li class="list-inline-item">
                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Terms</a>
                </li>
            </ul>
        </div>
    </div>
</div>

