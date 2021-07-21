<template>
  <div class="add_product" >
    <form method="" action="" enctype="multipart/form-data">
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" @change = "handleChange" :value="form.name">
    </div>
     <div class="form-group">
  <label for="details">Details:</label>
  <textarea class="form-control" rows="5" id="details" name="details" @change = "handleChange" :value="form.details"></textarea>
</div> 
    <div class="form-group">
      <label for="product_file">Email:</label>
      <input type="file" class="form-control" id="product_file" name="product_file" @change = "handleChange" :value="form.product_file">
    </div>
    <button class="btn btn-default" @click="onFormSubmit">Add</button>
  </form>
  </div>
</template>

<script>
export default {
  name: "Add_Product",
 
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
      this.form.product_file = event.target.files[0];
    },
    onFormSubmit(e){

      e.preventDefault();

      if(this.formValidation()) {
      this.form.name = document.getElementsByName("name")[0].value;
      this.form.details = document.getElementsByName("details")[0].value;
      
      const data_to = new FormData();
      data_to.append('name', this.form.name);
      data_to.append('details', this.form.details);
      data_to.append('product_file', this.form.product_file);
      
      this.$emit("onFormSubmit", data_to);
      }

    },
    formValidation(){
      if(document.getElementsByName("name")[0].value === "") {
      alert("Enter Product Name");
      return false;
      }
      if(document.getElementsByName("details")[0].value === "") {
      alert("Enter Product Details");
      return false;
      }
      if(document.getElementsByName("product_file")[0].value === "") {
      alert("Enter Product File or Photo");
      return false;
      }
      return true;
    }
  }
};
</script>

<style scoped>

</style>
