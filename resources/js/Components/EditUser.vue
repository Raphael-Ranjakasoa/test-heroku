<template>
  <div class="card m-3">
      <div class="card-header">
          <h3 class="text-center">EDITION </h3> 
      </div>
      <div class="card-body">
        <form action="" @submit.prevent="updateUser(user.id)">
          <div class="form-group">
              <label for="">Nom: </label>
              <input type="text" class="form-control" v-model="user.name" >
            </div>
          <div class="form-group">
              <label for="">Email: </label>
              <input type="email" class="form-control" v-model="user.email" >
          </div>
          <div class="form-group">
              <label for="">Née le: </label>
              <input type="date" class="form-control" v-model="user.dateBirth" >
          </div>
          <div class="form-group">
              <label for="">Mot de passe: </label>
              <input type="password" class="form-control" v-model="user.password">
          </div>
          <div class="form-group">
            <label for="">Inscrit en tantr que: </label>
            <select v-model="user.user_privilege" class="form-control">
                <option value="Admin">Administrateur</option>
                <option value="Agent">Agent</option>
            </select>
          </div>
          
          <div class="d-flex justify-content-between card-footer">
              <button type="submit" class="btn btn-success">Valider</button>
              <button class="btn btn-danger" @click="annulerEdition()">Annuler</button>
          </div>
        </form>
      </div>
  </div>
</template>

<script>
export default {
    data(){
        return{
            user: {},
            annuler: false,  
        }
    }, 
    
    created(){
        this.axios
            .get(`/api/users/${this.$route.params.id}/edit`)
            .then(res => {
                Event.$emit('edit', this.user)
                this.user = res.data
            })
    }, 

    methods: {
        updateUser(id){
            if(confirm('Modifier ?')){
                this.axios
                .put(`/api/users/${id}`, this.user)
                .then(res => {
                    Event.$emit('updateUser', this.user)
                    this.user = {}
                })
                .catch(err => console.log(err.message)) 
            }
        }, 

        annulerEdition(){
            if(confirm("Annuler l'edition? ")){
                this.user = {}
                Event.$emit('annulerEdition')
            }
        }
    }
}
</script>

<style>

</style>