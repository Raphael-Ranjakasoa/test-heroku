import ListUser from './Pages/ListUser'
import EditUser from './Components/EditUser'
import Profile from './Components/ProfileUser'
const routes = [
    {
        name:'list', 
        path:'/list', 
        component:ListUser
    },
    {
        name:'edit', 
        path:'/edit/:id', 
        component:EditUser
    },
    {
        name:'profile', 
        path:'/profile/:id', 
        component:Profile
    },
]

export default routes;