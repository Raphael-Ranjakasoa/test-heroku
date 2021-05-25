<template>
    <div class="row">
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Modal Header</h4>
                    </div>
                    <div class="modal-body">
                        <router-view></router-view>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-5">
            <span v-if="showEdit">
                <router-view></router-view>
            </span>
            <span v-else>
                <Add></Add>
            </span>
        </div>
        <div class="col-md-8 mt-5">
            <h3 class="text-center">LISTE DES UTILISATEURS</h3> 
            <table class="table table-bordered" id="tab">
                <thead class="text-center text-light bg-dark">
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Date de naissance</th>
                    <th>Privilège</th>
                    <th>Action</th>
                </thead>
                <tbody v-for="user in users" :key="user.id">
                    <tr>
                        <td> {{ user.name }} </td>
                        <td> {{ user.email }} </td>
                        <td> {{ user.dateBirth }} </td>
                        <td> {{ user.user_privilege }} </td>
                        <td class="text-center"> 
                            <router-link :to=" { name:'edit', params:{ id: user.id } } "><button :disabled="isEdit" @click="showEditPage()" class="btn btn-success">Editer</button> </router-link>
                            <router-link :to="{ name:'profile', params: { id: user.id } }"><button :disabled="isEdit" data-toggle="modal" @click="showProfile()" data-target="#myModal" class="btn btn-info">Plus</button></router-link>
                            <button :disabled="isEdit" class="btn btn-danger" @click="deleteUser(user.id)">Retirer</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import Add from '../Components/AddUser'
import Edit from '../Components/EditUser'
import Profile from '../Components/ProfileUser' 
export default {

    data(){
        return{
            users: [], 
            showEdit: false,
            isEdit: false,
            search: null,
            user: {}
        }
    },
    components: {
        Add, 
        Edit, 
        Profile
    }, 

    mounted(){
        this.getUser()
        Event.$on('addUser', (user)=>{
            this.users.push(user)
        })
        Event.$on('annulerEdition', ()=>{
            this.hideEditPage()
            this.$router.push({name:'list'})
        })
    }, 

    updated(){
        Event.$on('updateUser', (user)=>{
            this.getUser()
            this.hideEditPage()
            this.$router.push({name:'list'})
        })
    },

    methods:{
        async getUser(){
            await this.axios.get('/api/users')
                            .then(res => {
                                this.users = res.data
                            })
                            .catch(err => {
                                console.log(err)
                                this.users = []
                            })
        },

        deleteUser(id){
            if(confirm('Êtes-vous sure de retirer cet utilisateur?')){
                this.axios
                .delete(`/api/users/${id}`) 
                .then(res => {
                    let i = this.users.map(item => item.id).indexOf(id)
                    this.users.splice(i, 1) //splice(pos, nbElmSup)
                })
                .catch(err => console.log(err))
            }
        },

        showProfile(id){
            axios.get(`/api/users/${id}`)
                 .then(res =>{
                     this.user = res.data
                 })
                 .catch(err => console.log(err.message))
        },

        showEditPage(){
            this.showEdit = true
            this.isEdit = true
        }, 
        hideEditPage(){
            this.showEdit = false
            this.isEdit = false
        }, 
    },

}
</script>

<style>

</style>