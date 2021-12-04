<template>
<div>
    <div class="item">
    <input type="checkbox"
    @change="updateCheck()"
    v-model="item.completed"/>

    <span :class="[item.completed ? 'completed' : '','itemText' ]">{{item.name}}</span>
    </div>
    <button @click="removeItem()" class="plus1"> X</button>
</div>
</template>

<script>
export default {
    props:['item'],
    methods: {
        updateCheck : function() {
            axios.put('api/item/'+this.item.id , {
                item : this.item
            })
            .then ( response=> {
                if( response.status == 200){
                    this.$emit('itemchanged')
                }
            } )
            .catch( error => {
                console.log(error);
            })
        },
        removeItem :function(){
            axios.delete('api/item/'+this.item.id)
            .then(response =>{
                if(response.status ==200){
                    this.$emit('itemchanged');
                }
            })
            .catch ( error => {
                console.log(error);
            })
        }
    },
}
</script>

<style>
.completed{
    text-decoration: line-through;
    color: #9999;

}
.itemText{
    width: 100%;
    margin-left: 20px;

}
.item{
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.trashcan{
    background: red;
    color: aliceblue;
}
.plus1{

    color: aliceblue;
    background: grey;
    padding: 10px 15px;
    border-radius: 50%;
    margin-right: 5px;
    cursor: pointer;
}
</style>
