<template>
  <div class="login">
    



<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Login</button>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="" action="" enctype="multipart/form-data">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Email:</label>
            <input type="text" class="form-control" id="email" placeholder="Enter Email" name="email" @change = "handleChange" :value="form.email">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Password:</label>
            <input type="text" class="form-control" id="password" placeholder="Enter Password" name="password" @change = "handleChange" :value="form.password">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" @click="login">Login</button>
      </div>
    </div>
  </div>
</div>




  </div>
</template>

<script>
export default {
  name: "Login",
  props: {
    form: {
      type: Object
    }
  },
  methods: {
    handleChange(event){
      const { name, value } = event.target;
      let form = this.form;
      form[name] = value;
      this.form = form;
      
    },
    login(e){

      e.preventDefault();

      if(this.formValidation()) {
      this.form.email = document.getElementsByName("email")[0].value;
      this.form.password = document.getElementsByName("password")[0].value;
      this.$emit("login", this.form);
      }

    },
    formValidation(){
      if(document.getElementsByName("email")[0].value === "") {
      alert("Enter Email");
      return false;
      }
      if(document.getElementsByName("password")[0].value === "") {
      alert("Enter Password");
      return false;
      }
      return true;
    }
  }
};
</script>

<style scoped>

</style>
