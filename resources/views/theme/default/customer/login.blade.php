<x-layout>

    <div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card shadow-sm p-4" style="min-width: 350px; max-width: 400px; width: 100%; background-color: #d7e9ffff; color: #3D74B6;">
            <h3 class="mb-4 text-center">Login</h3>

            @if(session('errorMessage'))
            <div class="alert alert-danger">
                {{ session('errorMessage') }}
            </div>
            @endif

            @if(session('successMessage'))
            <div class="alert alert-success">
                {{ session('successMessage') }}
            </div>
            @endif

            <form method="POST" action="{{ route('customer.login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input
                        type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        style="border: 0.1rem solid #7f9cc1ff; border-radius: 5px;">

                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input
                        type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        id="password"
                        name="password"
                        required
                        style="border: 0.1rem solid #7f9cc1ff;; border-radius: 5px;">

                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember" style="border: 0.1rem solid #7f9cc1ff;; border-radius: 5px;">
                    <label class="form-check-label" for="remember">Remember Me</label>
                </div>
                <button type="submit" class="btn text-white w-100" style="background-color: #3D74B6;">Login</button>
                <div class="mt-3 text-center">
                    <small>
                        Belum punya akun?
                        <a href="{{ route('customer.register') }}">Daftar disini</a>
                    </small>
                </div>
            </form>
        </div>
    </div>
</x-layout>