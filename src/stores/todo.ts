import { reactive, ref } from "vue";
import { defineStore } from "pinia";
import ApiService from "@/core/services/ApiService";
import JwtService from "@/core/services/JwtService";

// interface T1 {
//   date: Date;
// }
// function print(date: Date) {
// }

// const reactiveObject = reactive<T1>({ date: new Date() });
// const pureObject: T1 = { date: new Date() };

// print(reactiveObject.date);
// print(pureObject.date);

export interface Todo {
  id:number;
    count: number;
    current_page: string;
    data: {
       date:  string;
      detail: string;
      imageAnswer: string;
      question: string;
      status: string;
      task_id:number;
     
    };
    first_page_url: string;
    next_page_url: string;
    path:string;
    previous_page_url:string;
    total:number;
   
}


export const useTodoStore = defineStore("todo", () => {
  const errors = ref({});
  const todoList = ref<Todo>({} as Todo);
  // const link = ref<Todo>({} as Todo);
  const isAuthenticated = ref(localStorage.getItem('accessToken'));

  function setError(error: any) {
    errors.value = { ...error };
  }


  function getCurrentPage(newurl: any) {
    return ApiService.get(newurl)
      .then(({ data }) => {
        todoList.value = data;
      })
      .catch(({ response }) => {
         setError(response.data);
        // setError(response.data.errors);
      });
  }

//   function logout() {
//     purgeAuth();
//   }

//   function register(credentials: User) {
//     return ApiService.post("register", credentials)
//       .then(({ data }) => {
//         setAuth(data);
//       })
//       .catch(({ response }) => {
//         setError(response.data.errors);
//       });
//   }

//   function forgotPassword(email: string) {
//     return ApiService.post("forgot_password", email)
//       .then(() => {
//         setError({});
//       })
//       .catch(({ response }) => {
//         setError(response.data.errors);
//       });
//   }

//   function verifyAuth() {
//     if (JwtService.getToken()) {
//       ApiService.setHeader();
//       ApiService.post("verify_token", { api_token: JwtService.getToken() })
//         .then(({ data }) => {
//           setAuth(data);
//         })
//         .catch(({ response }) => {
//           setError(response.data.errors);
//           purgeAuth();
//         });
//     } else {
//       purgeAuth();
//     }
//   }

  return {
     errors,
    todoList,
    getCurrentPage,
    
    //isAuthenticated,
    // login,
    // logout,
    // register,
    // forgotPassword,
    // verifyAuth,
  };
});
