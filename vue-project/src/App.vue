<template>
  <div id="app">
    <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">TinyProducts</a>
    </div>
    <!-- <ul class="nav navbar-nav">
      <li class="active"><a href="#/Home">Home</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="Login">Login</a></li>
          <li><a href="#">Page 1-2</a></li>
          <li><a href="#">Page 1-3</a></li>
        </ul>
      </li>
      <li><a href="#">Page 2</a></li>
      <li><a href="#">Page 3</a></li>
    </ul> -->
  </div>
  
</nav>
  
<div class="container">
<div v-if=homePageErase>
<Home :products= "products"/>
</div>
<br>
<router-view></router-view>
  <div v-if=isLoggedIn>
  <Add_Product :form = "form" @onFormSubmit="onFormSubmit"/>
  <br>
  <div>
    <Loader v-if="Loader"/>
    <Product_List :products= "products" @onDelete="onDelete"/>
  </div>
  </div>
  <br>
  <hr>
  <Login :form = "form" @login="login"/>

</div>

  </div>
</template>

<script>

import axios from "axios";
import VueSession from 'vue-session';
import Vue from 'vue'
Vue.use(VueSession);
import Add_Product from "./components/Add_Product";

import Product_List from "./components/Product_List";

import Home from "./components/Home";
import Login from './components/Login';
import Loader from './components/Loader';


export default {
  name: 'App',
  components: {
    Add_Product,
    Product_List,
    Home,
    Login,
    Loader
  },
  data(){
  return {
      isLoggedIn : false,
      homePageErase : true,
      Loader : false,
  
  url: "http://127.0.0.1:8000/api/Products",
  products: [],
  form: { name: "", details: "", product_file: "", email : "",
        password : "" },
  };
  
  },
  methods: {
     authenticate(data){
       
       
     axios.post('http://localhost:8000/api/Login', data).then((response) => {
          
          if(response.data.accessToken){
            this.isLoggedIn = true;
            this.homePageErase = false;
      localStorage.setItem('accessToken', response.data.accessToken);
          }
        }).catch(e => {
    alert(e);
    });
    this.isLoggedIn = false
    this.homePageErase = true
  },
      login(data) {
    if(data.isEdit){
//for Edit
    }
    else{
      this.authenticate(data);
    }
  },
  
  getProducts(){
    
  axios.get(this.url).then(data => {
  this.products = data.data;
  
  });
  },
  deleteProduct(id) {
    axios.delete("http://127.0.0.1:8000/api/Delete_Product/" + id, {
      headers: {
      Authorization : 'Bearer ' + localStorage.getItem('accessToken')
    }
    }).then(() => {
      this.getProducts();
    }).catch(e => {
    alert(e);
    });
  },
  createProduct(data){
    axios.post('http://127.0.0.1:8000/api/Store_Product', data, {
      headers: {
      Authorization : 'Bearer ' + localStorage.getItem('accessToken')
    }
    }).then(() => {
      this.Loader = true;
      this.getProducts();
    }).catch(e => {
    alert(e);
    });
    
  },
  onDelete(id) {
    alert("Are you sure?");
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



<style scoped>
.data {
  margin-top: 24px !important;
  float: right;
}
thread tr th {
  background: #e0e0e0 !important;
}
.ui.inverted.dimmer {
  background-color: rgba(255, 255, 255, 0) !important;
}
</style>
