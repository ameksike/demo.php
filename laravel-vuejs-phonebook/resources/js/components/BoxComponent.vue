<template>
    <div class="row">
            <div class="col-md-6" >
                <edit-component :data="selected" @onSave="save"></edit-component>  
            </div>
            <div class="col-md-6" >
                <list-component :data="list" @onDelete="dell" @onEdit="edit"></list-component>   
            </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                selected: {"id":0,"firstname":"","lastname":"","age":'',"sex":"","address":"","phone":"","avatar":"","pass":"","user":''},
                list: [
                    {"id":1,"firstname":"Dr Nice","lastname":"Mike","age":12,"sex":"M","address":"Lincon Street","phone":"85668899","avatar":"./assets/person/img2-small.jpg","pass":"","user":null},
                    {"id":2,"firstname":"Narco","lastname":"Mus Iliniscato ","age":25,"sex":"M","address":"Lincon Street","phone":"22668899","avatar":"./assets/person/img4-small.jpg","pass":null,"user":null},
                    {"id":3,"firstname":"Tornado","lastname":"Izquierdo Derecho","age":56,"sex":"M","address":"Lincon Street","phone":"52668899","avatar":"./assets/person/img2-small.jpg","pass":null,"user":null},
                    {"id":4,"firstname":"Magma","lastname":"Tusca Perez","age":15,"sex":"M","address":"Lincon Street","phone":"45668899","avatar":"./assets/person/img3-small.jpg","pass":"64sfsadf2as3df13asdf","user":"magma.mangrino"},
                    {"id":5,"firstname":"Dr IQ","lastname":"Ruso Chino","age":89,"sex":"M","address":"Lincon Street","phone":"24668899","avatar":"./assets/person/img5-small.jpg","pass":null,"user":null},
                    {"id":6,"firstname":"Dynama","lastname":"War Pess","age":7,"sex":"F","address":"Lincon Street","phone":"67668811","avatar":"./assets/person/img2-small.jpg","pass":null,"user":null}
                ]
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            save(item){
                item.id = this.list.length + 1;
                this.list.push(item);
                console.log('--------------- Box::save');
                console.log(item);
            },
            dell(item){
                console.log('--------------- Box::delete');
                console.log(item);
                let index = this.list.findIndex( i => i.id === item.id);
                this.list.splice(index, 1);
            },
            edit(item){
                console.log('--------------- Box::edit');
                this.selected = item;
                console.log(item);
            }
        }
    }
</script>
