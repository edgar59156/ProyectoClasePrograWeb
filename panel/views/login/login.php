<form method="POST" action="login.php?accion=login">
  <section class="vh-100" style="background-image: url(/centro_comunitario/image/login/fondo_login.jpg); background-size:1600px 960px; background-position: center; ">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img src="/ProyectoClase/panel/image/conferencia.jpg" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; width: auto; height: 600px;" />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">
                  <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="fa fa-box-arrow-in-right" style="color: #ff6219;"> </i>
                    <span class="h1 fw-bold mb-0">Iniciar Sesion</span>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="email" id="form2Example17" class="form-control form-control-lg" name="correo" />
                    <label class="form-label" for="form2Example17">Correo</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" id="form2Example27" class="form-control form-control-lg" name="contrasena" />
                    <label class="form-label" for="form2Example27">Contraseña</label>
                  </div>

                  <div class="pt-1 mb-4">
                    <button type="submit" class="btn btn-dark btn-lg btn-block" name="enviar" value="Ingresar">Ingresar</button>
                  </div>

                  <a class="small text-muted" href="login.php?accion=recovery">¿Olvidaste tu contrseña?</a>
                  <p class="mb-5 pb-lg-2" style="color: #393f81;">¿Aun no tienes cuenta? <a href="#!" style="color: #393f81;">Registrate aquí</a></p>
                  <a href="#!" class="small text-muted">Terminos de uso.</a>
                  <a href="#!" class="small text-muted">Politica de privacidad</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</form>