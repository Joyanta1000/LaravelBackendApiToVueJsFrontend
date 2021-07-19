<template>
  <div id="app">
    <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">TinyProducts</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Page 1-1</a></li>
          <li><a href="#">Page 1-2</a></li>
          <li><a href="#">Page 1-3</a></li>
        </ul>
      </li>
      <li><a href="#">Page 2</a></li>
      <li><a href="#">Page 3</a></li>
    </ul>
  </div>
</nav>
  
<div class="container">
  <Add_Product :form = "form" @onFormSubmit="onFormSubmit"/>
  <br>
  <Product_List :products= "products" @onDelete="onDelete"/>
</div>

  </div>
</template>

<script>

import axios from "axios";

import Add_Product from "./components/Add_Product";

import Product_List from "./components/Product_List";

export default {
  name: 'App',
  components: {
    Add_Product,
    Product_List
  },
  data(){
  return {
  url: "http://127.0.0.1:8000/api/Products",
  products: [],
  form: { name: "", details: "", product_file: "" },
  };
  },
  methods: {
  getProducts(){
  axios.get(this.url).then(data => {
  this.products = data.data;
  });
  },
  deleteProduct(id) {
    axios.delete("http://127.0.0.1:8000/api/Delete_Product/" + id).then(() => {
      this.getProducts();
    }).catch(e => {
    alert(e);
    });
  },
  createProduct(data){
    axios.post('http://127.0.0.1:8000/api/Store_Product', data).then(() => {
      this.getProducts();
    }).catch(e => {
    alert(e);
    });
  },
  onDelete(id) {
    this.deleteProduct(id);
  },
  onFormSubmit(data) {
    if(data.isEdit){
//for Edit
    }
    else{
      this.createProduct(data);
    }
  }
  },
  created() {
  this.getProducts();
  }
};
</script>

<style>

</style>
