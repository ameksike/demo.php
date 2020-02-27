<template>
    <div class="card">
        <div class="card-header"> 
            <h2 class="font-weight-blod text-center">List Phonebook</h2>
        </div>
        <div class="card-body">
            <table> 
                <thead>
                    <tr>
                        <th> Name </th>
                        <th> Age </th>
                        <th> Sex </th>
                        <th> Phone </th>
                        <th> Address </th>
                        <th> Actions </th>
                    </tr>
                </thead>
                <tbody>
                        <tr v-for="item in data" :key="item.id">
                            <td> {{item.firstname}} {{item.lastname}} </td>
                            <td> {{item.age}} </td>
                            <td> {{item.sex}} </td>
                            <td> {{item.phone}} </td>
                            <td> {{item.address}} </td>
                            <td> 
                                <button type="button"  class="btn btn-primary btn-sm" v-on:click="edit(item)"> Edit </button>
                                <button type="button"  class="btn btn-danger btn-sm" v-on:click="dell(item)"> Delete </button>
                            </td>
                        </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
        </div>
    </div>
</template>

<script>
    export default {
        props: ["data"],
        data(){
            return {
        
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            dell(item){
                console.log('--------------- List::delete');
                this.$emit('onDelete', item);
                console.log(item);
            },
            edit(item){
                console.log('--------------- List::edit');
                this.$emit('onEdit', item);
                console.log(item);
            }
        }
    }
</script>
