<template>
<div class="addItem">
    <input type="text" v-model="item.name">
    <span :class ="[item.name ? 'active' : 'inactive', 'plus']" @click="addItem()" >+</span>
</div>
</template>

<script>

export default {
data() {
    return {
        item:{
            name: ""
        }
    }
},
methods: {
    addItem : function(){
    if(this.item.name == ''){
        return;
    }
    axios.post('api/item/create',{
        item: this.item
    })
    .then(response =>{
        if(response.status == 201){
            this.item.name = "";
            this.$emit('reloadList')
        }
    })
    .catch(error =>{
        console.log(error);
    })
    }
},
}
</script>

<style scoped>

.addIte{
    display: flex;
    justify-content: center;
    align-items: center;

}
input{
    background: #f7f7f7;
    border: 0px;
    outline: none;
    padding: 12px;
    margin-right: 10px;
    width: 250px;
    border-radius: 10px;

}
.plus{
    font-size: 20px;
    font-weight: 900;

    background: greenyellow;
    padding: 10px 15px;
    border-radius: 50%;
    cursor: pointer;
}
.active{
    color: #f7f7f7;
    background: green;
    transition: ease-in-out .5s;
    }
.inactive{
    color: #fff;
    background-color: grey;
}
</style>
