var x=Object.defineProperty;var E=(r,e,s)=>e in r?x(r,e,{enumerable:!0,configurable:!0,writable:!0,value:s}):r[e]=s;var o=(r,e,s)=>(E(r,typeof e!="symbol"?e+"":e,s),s);import{D as v,d as S,ab as q,aA as L,ac as A,K as C,r as Q,o as B,v as N,L as F,_ as U,k as D,m as c,y as k,p as b,n as $,l as t,H as f}from"./index.40c6202a.js";import{c as I,a as g,d as O}from"./object.fb242430.js";import{S as y}from"./sweetalert2.all.fbc178e9.js";import{_ as T}from"./google-icon.903e953d.js";const _={minLength:8,checkUppercase:!0,checkLowercase:!0,checkDigit:!0,checkChar:!0,scoreHighlightClass:"active"},p={componentName:"password-meter",instanseQuery:"[data-kt-password-meter]",inputQuery:"input[type]",visibilityQuery:'[data-kt-password-meter-control="visibility"]',highlightQuery:'[data-kt-password-meter-control="highlight"]'},d=class{constructor(e,s,i){o(this,"element");o(this,"inputElement");o(this,"visibilityElement");o(this,"highlightElement");o(this,"options");o(this,"queries");o(this,"score");o(this,"checkSteps");o(this,"reset",()=>{this.score=0,this.highlight()});this.element=e,this.options=Object.assign(_,s),this.queries=i,this.score=0,this.checkSteps=5,this.inputElement=this.element.querySelector(this.queries.inputQuery),this.visibilityElement=this.element.querySelector(this.queries.visibilityQuery),this.highlightElement=this.element.querySelector(this.queries.highlightQuery),this.handlers(),v.set(this.element,this.queries.componentName,this)}handlers(){this.inputElement&&this.inputElement.addEventListener("input",()=>{this.check()}),this.visibilityElement&&this.visibilityElement.addEventListener("click",()=>{this.visitbility()})}visitbility(){if(this.visibilityElement&&this.inputElement){const e=this.visibilityElement.querySelector("i:not(.d-none), .svg-icon:not(.d-none)"),s=this.visibilityElement.querySelector("i.d-none, .svg-icon.d-none");(this.inputElement.getAttribute("type")||"")==="password"?this.inputElement.setAttribute("type","text"):this.inputElement.setAttribute("type","password"),e==null||e.classList.add("d-none"),s==null||s.classList.remove("d-none"),this.inputElement.focus()}}checkScore(){return 0}checkLength(){return this.inputElement?this.inputElement.value.length>=this.options.minLength:!1}checkLowerCase(){const e=this.inputElement?this.inputElement.value:"";return/[a-z]/.test(e)}checkUppercase(){const e=this.inputElement?this.inputElement.value:"";return/[A-Z]/.test(e)}checkDigit(){const e=this.inputElement?this.inputElement.value:"";return/[0-9]/.test(e)}checkChar(){const e=this.inputElement?this.inputElement.value:"";return/[~`!#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?]/g.test(e)}getCheckScore(){let e=1;return this.options.checkUppercase&&e++,this.options.checkLowercase&&e++,this.options.checkDigit&&e++,this.options.checkChar&&e++,this.checkSteps=e,100/this.checkSteps}highlight(){const e=this.highlightElement?[].slice.call(this.highlightElement.querySelectorAll("div")):[],s=e.length;let i=0;const u=this.getCheckScore(),l=this.getScore();e.map(n=>{i++,u*i*(this.checkSteps/s)<=l?n.classList.add("active"):n.classList.remove("active")})}getScore(){return this.score}check(){let e=0;const s=this.getCheckScore();this.checkLength()&&(e=e+s),this.options.checkUppercase&&this.checkLowerCase()&&(e=e+s),this.options.checkLowercase&&this.checkUppercase()&&(e=e+s),this.options.checkDigit&&this.checkDigit()&&(e=e+s),this.options.checkChar&&this.checkChar()&&(e=e+s),this.score=e,this.highlight()}};let m=d;o(m,"getInstance",(e,s=p.componentName)=>{const i=v.get(e,s);if(i)return i}),o(m,"createInstances",(e=p.instanseQuery,s=_,i=p)=>{document.body.querySelectorAll(e).forEach(l=>{const n=l;let a=d.getInstance(n);a||(a=new d(n,s,i))})}),o(m,"createInsance",(e=p.instanseQuery,s=_,i=p)=>{const u=document.body.querySelector(e);if(!u)return;const l=u;let n=d.getInstance(l);return n||(n=new d(l,s,i)),n}),o(m,"bootstrap",(e=p.instanseQuery)=>{d.createInstances(e)}),o(m,"reinitialization",(e=p.instanseQuery)=>{d.createInstances(e)});const V=S({name:"sign-up",components:{Field:q,VForm:L,ErrorMessage:A},setup(){const r=C(),e=F(),s=Q(null),i=I().shape({first_name:g().required().label("Name"),last_name:g().required().label("Surname"),email:g().min(4).required().email().label("Email"),password:g().required().label("Password"),password_confirmation:g().required().oneOf([O("password"),null],"Passwords must match").label("Password Confirmation")});return B(()=>{N(()=>{m.bootstrap()})}),{registration:i,onSubmitRegister:async l=>{var a,h;l=l,r.logout(),s.value.disabled=!0,(a=s.value)==null||a.setAttribute("data-kt-indicator","on"),await r.register(l);const n=Object.values(r.errors);n?y.fire({text:n[0],icon:"error",buttonsStyling:!1,confirmButtonText:"Try again!",heightAuto:!1,customClass:{confirmButton:"btn fw-semobold btn-light-danger"}}):y.fire({text:"You have successfully logged in!",icon:"success",buttonsStyling:!1,confirmButtonText:"Ok, got it!",heightAuto:!1,customClass:{confirmButton:"btn fw-semobold btn-light-primary"}}).then(function(){e.push({name:"dashboard"})}),(h=s.value)==null||h.removeAttribute("data-kt-indicator"),s.value.disabled=!1},submitButton:s}}}),R={class:"w-lg-500px p-10"},M={class:"mb-10 text-center"},j=t("h1",{class:"text-dark mb-3"},"Create an Account",-1),z={class:"text-gray-400 fw-semobold fs-4"},H=t("button",{type:"button",class:"btn btn-light-primary fw-bold w-100 mb-10"},[t("img",{alt:"Logo",src:T,class:"h-20px me-3"}),f(" Sign in with Google ")],-1),P=t("div",{class:"d-flex align-items-center mb-10"},[t("div",{class:"border-bottom border-gray-300 mw-50 w-100"}),t("span",{class:"fw-semobold text-gray-400 fs-7 mx-2"},"OR"),t("div",{class:"border-bottom border-gray-300 mw-50 w-100"})],-1),G={class:"row fv-row mb-7"},K={class:"col-xl-6"},Y=t("label",{class:"form-label fw-bold text-dark fs-6"},"First Name",-1),Z={class:"fv-plugins-message-container"},J={class:"fv-help-block"},W={class:"col-xl-6"},X=t("label",{class:"form-label fw-bold text-dark fs-6"},"Last Name",-1),ee={class:"fv-plugins-message-container"},te={class:"fv-help-block"},se={class:"fv-row mb-7"},ie=t("label",{class:"form-label fw-bold text-dark fs-6"},"Email",-1),oe={class:"fv-plugins-message-container"},ne={class:"fv-help-block"},ce={class:"mb-10 fv-row","data-kt-password-meter":"true"},re={class:"mb-1"},ae=t("label",{class:"form-label fw-bold text-dark fs-6"}," Password ",-1),le={class:"position-relative mb-3"},he={class:"fv-plugins-message-container"},me={class:"fv-help-block"},de=t("div",{class:"d-flex align-items-center mb-3","data-kt-password-meter-control":"highlight"},[t("div",{class:"flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"}),t("div",{class:"flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"}),t("div",{class:"flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"}),t("div",{class:"flex-grow-1 bg-secondary bg-active-success rounded h-5px"})],-1),ue=t("div",{class:"text-muted"}," Use 8 or more characters with a mix of letters, numbers & symbols. ",-1),pe={class:"fv-row mb-5"},fe=t("label",{class:"form-label fw-bold text-dark fs-6"},"Confirm Password",-1),ge={class:"fv-plugins-message-container"},be={class:"fv-help-block"},_e={class:"fv-row mb-10"},ve={class:"form-check form-check-custom form-check-solid"},ke=t("span",{class:"form-check-label fw-semobold text-gray-700 fs-6"},[f(" I Agree & "),t("a",{href:"#",class:"ms-1 link-primary"},"Terms and conditions"),f(". ")],-1),ye={class:"text-center"},we={id:"kt_sign_up_submit",ref:"submitButton",type:"submit",class:"btn btn-lg btn-primary"},xe=t("span",{class:"indicator-label"}," Submit ",-1),Ee=t("span",{class:"indicator-progress"},[f(" Please wait... "),t("span",{class:"spinner-border spinner-border-sm align-middle ms-2"})],-1),Se=[xe,Ee];function qe(r,e,s,i,u,l){const n=b("router-link"),a=b("Field"),h=b("ErrorMessage"),w=b("VForm");return $(),D("div",R,[c(w,{class:"form w-100 fv-plugins-bootstrap5 fv-plugins-framework",novalidate:"",onSubmit:r.onSubmitRegister,id:"kt_login_signup_form","validation-schema":r.registration},{default:k(()=>[t("div",M,[j,t("div",z,[f(" Already have an account? "),c(n,{to:"/sign-in",class:"link-primary fw-bold"},{default:k(()=>[f(" Sign in here ")]),_:1})])]),H,P,t("div",G,[t("div",K,[Y,c(a,{class:"form-control form-control-lg form-control-solid",type:"text",placeholder:"",name:"first_name",autocomplete:"off"}),t("div",Z,[t("div",J,[c(h,{name:"first_name"})])])]),t("div",W,[X,c(a,{class:"form-control form-control-lg form-control-solid",type:"text",placeholder:"",name:"last_name",autocomplete:"off"}),t("div",ee,[t("div",te,[c(h,{name:"last_name"})])])])]),t("div",se,[ie,c(a,{class:"form-control form-control-lg form-control-solid",type:"email",placeholder:"",name:"email",autocomplete:"off"}),t("div",oe,[t("div",ne,[c(h,{name:"email"})])])]),t("div",ce,[t("div",re,[ae,t("div",le,[c(a,{class:"form-control form-control-lg form-control-solid",type:"password",placeholder:"",name:"password",autocomplete:"off"}),t("div",he,[t("div",me,[c(h,{name:"password"})])])]),de]),ue]),t("div",pe,[fe,c(a,{class:"form-control form-control-lg form-control-solid",type:"password",placeholder:"",name:"password_confirmation",autocomplete:"off"}),t("div",ge,[t("div",be,[c(h,{name:"password_confirmation"})])])]),t("div",_e,[t("label",ve,[c(a,{class:"form-check-input",type:"checkbox",name:"toc",value:"1"}),ke])]),t("div",ye,[t("button",we,Se,512)])]),_:1},8,["onSubmit","validation-schema"])])}const Ne=U(V,[["render",qe]]);export{Ne as default};
