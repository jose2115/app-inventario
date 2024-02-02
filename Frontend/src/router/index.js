import { createRouter, createWebHashHistory } from 'vue-router'
import authRouter from '../modules/auth/router'

import daybookRouter from '../modules/daybook/router'
import authGuard from '../modules/auth/router/auth-guard'

const routes = [
  {
    path: '/',
    ...daybookRouter,
    beforeEnter: [ authGuard ],
  },
  {
    path: '/auth',
    ...authRouter,
  },
 
  
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
