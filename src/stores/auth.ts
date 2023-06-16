import { ref } from "vue";
import { defineStore } from "pinia";
import ApiService from "@/core/services/ApiService";
import JwtService from "@/core/services/JwtService";
import { getCurrentLanguage, getDirection } from "@/utils";

export interface User {
  name: string;
  surname: string;
  email: string;
  password: string;
  api_token: string;
}

export const useAuthStore = defineStore("auth", () => {
  const errors = ref<string>("");
  const user = ref<User>({} as User);
  const isAuthenticated = ref(!!JwtService.getToken());
  const isAdmin = ref<Boolean>(false);

  function setAuth(authUser: User) {
    isAuthenticated.value = true;
    user.value = authUser;
    errors.value = "";
    JwtService.saveToken(user.value.api_token);
  }

  function setError(error: any) {
    errors.value =  error ;
  }

  function purgeAuth() {
    isAuthenticated.value = false;
    user.value = {} as User;
    errors.value = "";
    JwtService.destroyToken();
    localStorage.removeItem("access_token");
    localStorage.removeItem("loggeduser");
    localStorage.removeItem("logged_user_id");
    localStorage.removeItem("role_id");
    localStorage.removeItem("user");
    localStorage.removeItem('user_role');
      // localStorage.setItem("lang", 'ar');
      //   localStorage.setItem('direction', 'rtl');
     
  }

  function login(credentials: User) {
    return ApiService.post("admin/login", credentials)
      .then(({ data }) => {
        let loggeduser=data.user.firstname;
             let access_token=data.access_token
             let logged_user_id=data.user.id
             let role_id=data.user.role_id
             let role_name = data.role.role_name
             let user= data.user
             if(role_name == 'admin'){
              isAdmin.value = true;
             }
             localStorage.setItem('access_token',access_token);
             isAuthenticated.value = true;
             localStorage.setItem('user',user)
             localStorage.setItem('loggeduser',loggeduser)
             localStorage.setItem('logged_user_id',logged_user_id)
             localStorage.setItem('role_id',role_id)
             localStorage.setItem('user_role',role_name)
             localStorage.setItem('permissions',data.permissions)
             const locale = getCurrentLanguage();
            localStorage.setItem("lang", locale);
            const direction = getDirection();
              localStorage.setItem('direction', direction.direction);
        setAuth(data);
      })
      .catch(({ response }) => {
        if(response.data.success === false){
          setError(response.data.message);
        }else if(response.status =='422'){
          setError(response.data.password);
        }
        // setError(response.data.errors);
      });
  }

  function logout() {
    purgeAuth();
  }

  function register(credentials: User) {
    return ApiService.post("register", credentials)
      .then(({ data }) => {
        setAuth(data);
      })
      .catch(({ response }) => {
        setError(response.data.errors);
      });
  }

  function forgotPassword(email: string) {
    return ApiService.post("forgot_password", email)
      .then(() => {
        setError({});
      })
      .catch(({ response }) => {
        setError(response.data.errors);
      });
  }

  function verifyAuth() {
    if (JwtService.getToken()) {
      ApiService.setHeader();
      ApiService.post("verify_token", { api_token: JwtService.getToken() })
        .then(({ data }) => {
          setAuth(data);
        })
        .catch(({ response }) => {
          setError(response.data.errors);
          purgeAuth();
        });
    } else {
      purgeAuth();
    }
  }

  return {
    errors,
    user,
    isAuthenticated,
    login,
    logout,
    register,
    forgotPassword,
    verifyAuth,
    isAdmin,
  };
});
