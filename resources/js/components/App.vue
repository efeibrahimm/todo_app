<template>
  <div class="todoListContainer">
    <div class="heading">
      <h2 id="title">Add Todo</h2>
      <add-item-form v-on:reloadList="getList()"></add-item-form>
    </div>
    <div class="col-3">
        <div class="col-2">
          <h2 id="title">Todo List</h2>

        <list-view :items="items" v-on:reloadList="getList()"></list-view>
    </div>
    <div class="col-2">
          <h2 id="title">Completed Todo</h2>

        <list-view :items="completedItems" v-on:reloadList="getList()"></list-view>
    </div>
    </div>
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
          items:[],
          completedItems :[]
      }
  },
  methods: {
      getList : function(){
          axios.get('api/items')
          .then(response => {
              this.getUnCompleted(response.data);
              this.getCompleted(response.data);
          })
          .catch(error=>{
              console.log(error);
          })
      },
      getCompleted: function(items) {
        this.completedItems = items.filter(items => items.completed == true);
      },
      getUnCompleted: function(items) {
        this.items = items.filter(items => items.completed == false);
      }
  },
  created(){
      this.getList();
  }
};
</script>

<style scoped>
.todoListContainer{
    width: 1000px;
    margin:auto;

}
.col-3{
    display: flex;
    flex-wrap: wrap;
}
.col-2{
        width:490px;
        background: #E6E6E6;
        margin-top: 10px;
        margin-left: 10px;

}
.heading{
    background: #E6E6E6;
    padding: 10px;
    width: 350px;
    margin: auto;
}
#title{
    text-align: center;
}
</style>
