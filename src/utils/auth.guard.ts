 import { isAuthGuardActive } from '../components/constants/config'
import { setCurrentUser, getCurrentUser } from '.'
import { useAuthStore } from '@/stores/auth';
import { useConfigStore } from '@/stores/config';
export default (to, from, next) => {
  const authStore = useAuthStore();
   const configStore = useConfigStore();
   document.title = `${to.meta.pageTitle} - ${import.meta.env.VITE_APP_NAME}`;
   configStore.resetLayoutConfig();
  if (to.matched.some(record => record.meta.loginRequired)) {
    if (isAuthGuardActive) {
      const user = getCurrentUser();
      if (user) {
        const permisions=localStorage.getItem('permissions')
        const roleArrayHierarchic = to.matched.filter(x => x.meta.roles).map(x => x.meta.roles);

        if (roleArrayHierarchic[0].some(x => permisions?.includes(x))) {
          next();
        } else {
          next('/unauthorized')
        }
        next();
      } else {
        setCurrentUser(null);
        next('/sign-in')

      //   next({
      //     path: "/user/login",
      //     query: { redirect: to.fullPath }
      // });
      }
    } else {
      next();
    }
  } else {
    if(localStorage.getItem('access_token')!==null)
    {
      next('/dashboard')
    }
    next()
  }

  window.scrollTo({
    top: 0,
    left: 0,
    behavior: "smooth",
  });
}
