import { createStore } from 'vuex'

import auth from '../modules/auth/store'
import importados from '../modules/daybook/store/importado'
import products  from '../modules/daybook/store/products'
import inventario from '../modules/daybook/store/inventario'
import users from '../modules/daybook/store/Users'
import roles from '../modules/daybook/store/Roles'
import profile from '../modules/daybook/store/Profile'


const store = createStore({
    modules: {
        auth,
        users,
        roles,
        profile,
        importados,
        products,
        inventario
    }
})




export default store