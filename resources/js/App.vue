<template>
    <div class="Container">
        <ListUser></ListUser>
    </div>
</template>

<script>
import ListUser from './Pages/ListUser.vue'
export default {
    name: 'app', 
    components: { 
        ListUser
    }
}
</script>