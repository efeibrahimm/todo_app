<template>
  <div class="todoListContainer">
    <div class="heading">
      <h2 id="title">Todo List</h2>
      <add-item-form v-on:reloadList="getList()"></add-item-form>
    </div>
    <list-view :items="items" v-on:reloadList="getList()"></list-view>
  </div>
</template>

<script>
import addItemForm from "./addItemForm";
import listView from './listView';
export default {
  components: {
    addItemForm,
    listView,
  },
  data() {
      return {
          items:[]
      }
  },
  methods: {
      getList : function(){
          axios.get('api/items')
          .then(response => {
              this.items =response.data
          })
          .catch(error=>{
              console.log(error);
          })
      }
  },
  created(){
      this.getList();
  }
};
</script>

<style scoped>
.todoListContainer{
    width: 350px;
    margin:auto;

}
.heading{
    background: #e6e6e6;
    padding: 10px;
}
#title{
    text-align: center;
}
</style>
