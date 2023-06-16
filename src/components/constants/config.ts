 import { UserRole } from "../../utils/auth.roles";

export const defaultMenuType = 'menu-default' // 'menu-default', 'menu-sub-hidden', 'menu-hidden';
export const adminRoot = '/app';
export const searchPath = `${adminRoot}/pages/miscellaneous/search`
export const buyUrl = 'https://1.envato.market/nEyZa'
export const apiUrl = 'http://forms.innovativeideasbox.com/API/api';
// export const apiUrl = 'http://commodityex.net/api';

export const subHiddenBreakpoint = 1440
export const menuHiddenBreakpoint = 768

export const defaultLocale = 'ar'
export const defaultDirection = 'rtl'
export const localeOptions = [
  { id: 'en', name: 'English', direction: 'ltr', src:'/media/flags/united-states.svg' },
  { id: 'es', name: 'Español', direction: 'ltr' , src:'/media/flags/spain.svg'},
  { id: 'enrtl', name: 'English RTL', direction: 'rtl', src:'/media/flags/united-states.svg' },
   { id: 'ar', name: 'ar', direction: 'rtl' , src:'/media/flags/united-states.svg' },

]

export const firebaseConfig = {
  apiKey: "AIzaSyDe94G7L-3soXVSpVbsYlB5DfYH2L91aTU",
  authDomain: "piaf-vue-login.firebaseapp.com",
  databaseURL: "https://piaf-vue-login.firebaseio.com",
  projectId: "piaf-vue-login",
  storageBucket: "piaf-vue-login.appspot.com",
  messagingSenderId: "557576321564",
  appId: "1:557576321564:web:bc2ce73477aff5c2197dd9"
};




export const currentUser = {
  id: 1,
  title: 'Sarah Kortney',
  img: '/assets/img/profiles/l-1.jpg',
  date: 'Last seen today 15:24',
  role: 'Admin'
}

export const isAuthGuardActive = true
export const themeRadiusStorageKey = 'theme_radius'
export const themeSelectedColorStorageKey = 'theme_selected_color'
export const defaultColor = 'light.blueolympic'
export const colors = ['bluenavy', 'blueyale', 'blueolympic', 'greenmoss', 'greenlime', 'purplemonster', 'orangecarrot', 'redruby', 'yellowgranola', 'greysteel']
