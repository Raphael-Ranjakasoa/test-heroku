<template>
  <div class="card m-3">
      <div class="card-header">
          <h3 class="text-center">INSCRIPTION</h3> 
      </div>
      <div class="card-body">
        <form @submit.prevent="ajouter()" name="form" enctype="multipart/form-data">
          <div class="form-group">
              <label for="">Nom: </label>
              <input type="text" class="form-control" v-model="user.name" placeholder="Saisissez votre nom et prénom(s), s.v.p." required>
            </div>
          <div class="form-group">
              <label for="">Email: </label>
              <input type="email" class="form-control" v-model="user.email" placeholder="Saisissez votre email" required>
          </div>
          <div class="form-group">
              <label for="">Née le: </label>
              <input type="date" class="form-control" v-model="user.dateBirth" >
          </div>
          <div class="form-group">
              <label for="">Mot de passe: </label>
              <input type="password" class="form-control" v-model="user.password" >
          </div>
           <!-- <div class="form-group">
              <label for="">Photo: </label>
              <input type="file" class="form-control">
          </div> -->
          <div class="form-group">
            <label for="">Inscrit en tant que: </label>
            <select v-model="user.user_privilege" class="form-control">
                <option value="Admin">Administrateur</option>
                <option value="Agent">Agent</option>
            </select>
          </div>
          <div class="card-footer d-flex justify-content-between">
              <button type="submit" class="btn btn-info">Ajouter</button>
              <button class="btn btn-danger" @click="resetForm()">Reset</button>
          </div>
        </form>
      </div>
  </div>
</template>

<script>
export default {
    name: 'utilisateur',
    data(){
        return{
            user:{}
        }
    }, 

    methods:{
         ajouter(){
            axios.post('/api/users', this.user)
                 .then(res => {
                    Event.$emit('addUser', this.user)
                    this.$router.push({name: 'list'})
                    this.user = {}
                 })
                 .catch(err => console.log(err.message))
        }, 

        resetForm(){
            document.forms.form.reset()
        }
    }
}
</script>

<style>

</style>