<template>
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="forget-pass">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                <div class="payment-main-popup payment-view-popup">
                  <div class="payment-modal-main">
                    <div class="payment-modal-inner">
                      <div class="row">
                        <div class="col-12">
                          <img src="images/pass-logo.png">
                          <h1>Password Recovery</h1>
                        </div>
                        <div class="col-12 form-group">
                          <i class="fa fa-pencil" aria-hidden="true"></i><input type="text" class="form-control" spellcheck="true" placeholder="Enter Verification Code">
                        </div>
                        <div class="col-12 form-group text-center">
                          <button type="button" class="can" data-dismiss="modal" id="cont2">Continue</button>
                        </div>
                        <div class="col-12 form-group">
                          <a href="login.html" class="login back"><i class="fa fa-long-arrow-left"></i>back to login</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
</template>

<script>
export default {

}
</script>

<style>

</style>