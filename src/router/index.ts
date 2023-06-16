import {
  createRouter,
  createWebHashHistory,
  createWebHistory,
  type RouteRecordRaw,
} from "vue-router";
import { useAuthStore } from "@/stores/auth";
import { useConfigStore } from "@/stores/config";
import { UserRole } from "@/utils/auth.roles";
import { Role } from "@/utils/role";
import AuthGuard from "@/utils/auth.guard";
const routes: Array<RouteRecordRaw> = [
  {
    path: "/",
    redirect: "/dashboard",
    component: () => import("@/layouts/main-layout/MainLayout.vue"),
    meta: {
      middleware: "auth",
      loginRequired: true
      
    },
    children: [
      {
        path: "/dashboard",
        name: "dashboard",
        component: () => import("@/views/Dashboard.vue"),
        meta: {
          pageTitle: "dashboard",
          breadcrumbs: ["dashboard"],
          roles: [UserRole.home, Role.Admin]
        },
      },
      // {
      //   path: "/builder",
      //   name: "builder",
      //   component: () => import("@/views/LayoutBuilder.vue"),
      //   meta: {
      //     pageTitle: "Layout Builder",
      //     breadcrumbs: ["Layout"],
      //   },
      // },
      // {
      //   path: "/crafted/pages/profile",
      //   name: "profile",
      //   component: () => import("@/components/page-layouts/Profile.vue"),
      //   meta: {
      //     breadcrumbs: ["Pages", "Profile"],
      //   },
      //   children: [
      //     {
      //       path: "overview",
      //       name: "profile-overview",
      //       component: () =>
      //         import("@/views/crafted/pages/profile/Overview.vue"),
      //       meta: {
      //         pageTitle: "Overview",
      //       },
      //     },
      //     {
      //       path: "projects",
      //       name: "profile-projects",
      //       component: () =>
      //         import("@/views/crafted/pages/profile/Projects.vue"),
      //       meta: {
      //         pageTitle: "Projects",
      //       },
      //     },
      //     {
      //       path: "campaigns",
      //       name: "profile-campaigns",
      //       component: () =>
      //         import("@/views/crafted/pages/profile/Campaigns.vue"),
      //       meta: {
      //         pageTitle: "Campaigns",
      //       },
      //     },
      //     {
      //       path: "documents",
      //       name: "profile-documents",
      //       component: () =>
      //         import("@/views/crafted/pages/profile/Documents.vue"),
      //       meta: {
      //         pageTitle: "Documents",
      //       },
      //     },
      //     {
      //       path: "connections",
      //       name: "profile-connections",
      //       component: () =>
      //         import("@/views/crafted/pages/profile/Connections.vue"),
      //       meta: {
      //         pageTitle: "Connections",
      //       },
      //     },
      //     {
      //       path: "activity",
      //       name: "profile-activity",
      //       component: () =>
      //         import("@/views/crafted/pages/profile/Activity.vue"),
      //       meta: {
      //         pageTitle: "Activity",
      //       },
      //     },
      //   ],
      // },
      // {
      //   path: "/crafted/pages/wizards/horizontal",
      //   name: "horizontal-wizard",
      //   component: () => import("@/views/crafted/pages/wizards/Horizontal.vue"),
      //   meta: {
      //     pageTitle: "Horizontal",
      //     breadcrumbs: ["Pages", "Wizard"],
      //   },
      // },
      // {
      //   path: "/crafted/pages/wizards/vertical",
      //   name: "vertical-wizard",
      //   component: () => import("@/views/crafted/pages/wizards/Vertical.vue"),
      //   meta: {
      //     pageTitle: "Vertical",
      //     breadcrumbs: ["Pages", "Wizard"],
      //   },
      // },
      // {
      //   path: "/crafted/account",
      //   name: "account",
      //   component: () => import("@/views/crafted/account/Account.vue"),
      //   meta: {
      //     breadcrumbs: ["Crafted", "Account"],
      //   },
      //   children: [
      //     {
      //       path: "overview",
      //       name: "account-overview",
      //       component: () => import("@/views/crafted/account/Overview.vue"),
      //       meta: {
      //         pageTitle: "Overview",
      //       },
      //     },
      //     {
      //       path: "settings",
      //       name: "account-settings",
      //       component: () => import("@/views/crafted/account/Settings.vue"),
      //       meta: {
      //         pageTitle: "Settings",
      //       },
      //     },
      //   ],
      // },
      // {
      //   path: "/apps/customers/getting-started",
      //   name: "apps-customers-getting-started",
      //   component: () => import("@/views/apps/customers/GettingStarted.vue"),
      //   meta: {
      //     pageTitle: "Getting Started",
      //     breadcrumbs: ["Apps", "Customers"],
      //   },
      // },
      // {
      //   path: "/apps/customers/customers-listing",
      //   name: "apps-customers-listing",
      //   component: () => import("@/views/apps/customers/CustomersListing.vue"),
      //   meta: {
      //     pageTitle: "Customers Listing",
      //     breadcrumbs: ["Apps", "Customers"],
      //   },
      // },
      // {
      //   path: "/apps/customers/customer-details",
      //   name: "apps-customers-details",
      //   component: () => import("@/views/apps/customers/CustomerDetails.vue"),
      //   meta: {
      //     pageTitle: "Customers Details",
      //     breadcrumbs: ["Apps", "Customers"],
      //   },
      // },
      // {
      //   path: "/apps/subscriptions/getting-started",
      //   name: "apps-subscriptions-getting-started",
      //   component: () =>
      //     import("@/views/apps/subscriptions/GettingStarted.vue"),
      //   meta: {
      //     pageTitle: "Getting Started",
      //     breadcrumbs: ["Apps", "Subscriptions"],
      //   },
      // },
      // {
      //   path: "/apps/subscriptions/subscription-list",
      //   name: "apps-subscriptions-subscription-list",
      //   component: () =>
      //     import("@/views/apps/subscriptions/SubscriptionList.vue"),
      //   meta: {
      //     pageTitle: "Getting Started",
      //     breadcrumbs: ["Apps", "Subscriptions"],
      //   },
      // },
      // {
      //   path: "/apps/subscriptions/add-subscription",
      //   name: "apps-subscriptions-add-subscription",
      //   component: () =>
      //     import("@/views/apps/subscriptions/AddSubscription.vue"),
      //   meta: {
      //     pageTitle: "Add Subscription",
      //     breadcrumbs: ["Apps", "Subscriptions"],
      //   },
      // },
      // {
      //   path: "/apps/subscriptions/view-subscription",
      //   name: "apps-subscriptions-view-subscription",
      //   component: () =>
      //     import("@/views/apps/subscriptions/ViewSubscription.vue"),
      //   meta: {
      //     pageTitle: "View Subscription",
      //     breadcrumbs: ["Apps", "Subscriptions"],
      //   },
      // },
      // {
      //   path: "/apps/calendar",
      //   name: "apps-calendar",
      //   component: () => import("@/views/apps/Calendar.vue"),
      //   meta: {
      //     pageTitle: "Calendar",
      //     breadcrumbs: ["Apps"],
      //   },
      // },
      // {
      //   path: "/apps/chat/private-chat",
      //   name: "apps-private-chat",
      //   component: () => import("@/views/apps/chat/Chat.vue"),
      //   meta: {
      //     pageTitle: "Private Chat",
      //     breadcrumbs: ["Apps", "Chat"],
      //   },
      // },
      // {
      //   path: "/apps/chat/group-chat",
      //   name: "apps-group-chat",
      //   component: () => import("@/views/apps/chat/Chat.vue"),
      //   meta: {
      //     pageTitle: "Group Chat",
      //     breadcrumbs: ["Apps", "Chat"],
      //   },
      // },
      // {
      //   path: "/apps/chat/drawer-chat",
      //   name: "apps-drawer-chat",
      //   component: () => import("@/views/apps/chat/DrawerChat.vue"),
      //   meta: {
      //     pageTitle: "Drawer Chat",
      //     breadcrumbs: ["Apps", "Chat"],
      //   },
      // },
      
      {
        path: "/dashboard/default",
        name: "default",
        component: () => import("@/views/dashboard/Default.vue"),
        meta: {
          pageTitle: "generalratios",
          breadcrumbs: ["dashboard", "default"],
          roles: [UserRole.dashboard] 
        },
      },
      {
        path: "/dashboard/Em_default",
        name: "default_em",
        component: () => import("@/views/dashboard/Default_em.vue"),
        meta: {
          pageTitle: "Generalpercentagesem",
          breadcrumbs: ["dashboard", "default_em"],
          roles: [UserRole.dashboard] 
        },
      },
      {
        path: "/permissions/:user_id",
        name: "permissions",
        component: () => import("@/views/dashboard/userrloes.vue"),
        props:true,
        meta: {
          pageTitle: "userpermission",
          breadcrumbs: ["dashboard", "permissions"],
          roles: [UserRole.user_management]
        }, 
      },
      {
        path: "/apps/reports/pendingtask/:cat",
        name: "pendingtask",
        component: () => import("@/views/apps/reports/pendingtask.vue"),
        props:true,
        meta: {
          pageTitle: "pendingtask",
          breadcrumbs: ["dashboard", "pendingtask"],
          roles: [UserRole.reports] 
        }, 
      },
    
       {
        path: "/dashboard/password",
        name: "password",
        component: () => import("@/views/dashboard/password.vue"),
        meta: {
          pageTitle: "changepassword",
          breadcrumbs: ["dashboard", "password"],
          roles: [UserRole.home]
        },
      },
      {
        path: "/reports/unitsstatusreport/:text?/:t_id?",
        name: "unitsstatusreport",
        component: () => import("@/views/apps/reports/unitsstatusreport.vue"),
        props:true,
        meta: {
          //pageTitle: "النسب العامة الخاصة بالطوارئ",
          breadcrumbs: ["Dashboard", "unitsstatusreport"],
          roles: [UserRole.reports] 
        },
      },
    
      {
        path: "/apps/reports/notcompletedtask/:cat",
        name: "notcompletedtask",
        component: () => import("@/views/apps/reports/notcompletedtask.vue"),
        props:true,
        meta: {
          pageTitle: "rejectassign",
          breadcrumbs: ["Reports", "rejectassign"],
          roles: [UserRole.reports] 
        },
      },
      {
        path: "/apps/reports/completedtask/:cat",
        name: "completedtask",
        component: () => import("@/views/apps/reports/completedtask.vue"),
        props:true,
        meta: {
          pageTitle: "completedtask",
          breadcrumbs: ["Reports", "completedtask"],
          roles: [UserRole.reports] 
        },
      },
      {
        path: "/apps/reports/surveylistforreport",
        name: "surveylistforreport",
        component: () => import("@/views/apps/reports/surveylistforreport.vue"),
        props:true,
        meta: {
          //pageTitle: "المهام المكتملة ",
          breadcrumbs: ["Reports", "surveylistforreport"],
          roles: [UserRole.reports] 
        },
      },
      {
        path: "/surveylistforreport/:id",
        name: "unitreport",
        component: () => import("@/views/apps/reports/unitreport.vue"),
        props:true,
        meta: {
         // pageTitle: "المهام المكتملة ",
          breadcrumbs: ["Reports", "unitreport"],
          roles: [UserRole.reports] 
        },
      },
      {
        path: "/success/:id",
        name: "success",
        component: () => import("@/views/apps/reports/success.vue"),
        props:true,
        meta: {
         // pageTitle: "المهام المكتملة ",
          breadcrumbs: ["Reports", "success"],
          roles: [UserRole.add_asnwers]
        },
      },
      {
        path: "/app/reports/units_status_em",
        name: "units_status_em",
        component: () => import("@/views/apps/reports/units_status_em.vue"),
        props:true,
        meta: {
          pageTitle: "passingpercentage",
          breadcrumbs: ["Reports", "units_status_em"],
          roles: [UserRole.reports]
        },
      },
      {
        path: "/app/reports/units_status_hr",
        name: "units_status_hr",
        component: () => import("@/views/apps/reports/units_status_hr.vue"),
        props:true,
        meta: {
          pageTitle: "passingpercentage",
          breadcrumbs: ["Reports", "units_status_hr"],
          roles: [UserRole.reports]
        },
      },
      {
        path: "/app/reports/performance/em",
        name: "performance_em",
        component: () => import("@/views/apps/reports/performance_em.vue"),
        props:true,
        meta: {
          pageTitle: "reportstaffem",
          breadcrumbs: ["Reports", "performance_em"],
          roles: [UserRole.reports]
        },
      },
      {
        path: "/app/reports/performance/hr",
        name: "performance_hr",
        component: () => import("./../views/apps/reports/performance_hr.vue"),
        props:true,
        meta: {
          pageTitle: "reportstaffhr",
          breadcrumbs: ["Reports", "performance_hr"],
          roles: [UserRole.reports]
        },
      },
      {
        path: "/app/reports/human_resource",
        name: "human_resource",
        component: () => import("@/views/apps/reports/human_resource.vue"),
        props:true,
        meta: {
          pageTitle: "hrreport",
          breadcrumbs: ["Reports", "human_resource"],
          roles: [UserRole.reports]
        },
      },
      {
        path: "/app/reports/emergency_report",
        name: "emergency_report",
        component: () => import("@/views/apps/reports/emergency_report.vue"),
        props:true,
        meta: {
          pageTitle: "emreport",
          breadcrumbs: ["Reports", "emergency_report"],
          roles: [UserRole.reports]
        },
      },
      {
        path: "/masters/contractor",
        name: "contractor",
        component: () => import("@/views/dashboard/contractor.vue"),
        meta: {
          pageTitle: "contractorlist",
          breadcrumbs: ["masters", "contractor"],
          roles: [UserRole.admin]
        },
      },
      {
        path: "/masters/unitsupdate",
        name: "unitsupdate",
        component: () => import("@/views/dashboard/unitsupdate.vue"),
        meta: {
          pageTitle: "listunits",
          breadcrumbs: ["masters", "unitsupdate"],
          roles: [UserRole.admin]
        },
      },
      {
        path: "/masters/unitestypes",
        name: "unitestypes",
        component: () => import("@/views/dashboard/unitestypes.vue"),
        meta: {
          pageTitle: "listunittypes",
          breadcrumbs: ["masters", "Unitestypes"],
          roles: [UserRole.admin]
        },
      },
      {
        path: "/masters/usersupdate",
        name: "usersupdate",
        component: () => import("@/views/dashboard/usersupdate.vue"),
        meta: {
          pageTitle: "listofusers",
          breadcrumbs: ["masters", "usersupdate"],
          roles: [UserRole.admin] 
        },
      },
      {
        path: "/masters/roles",
        name: "roles",
        component: () => import("@/views/dashboard/roles.vue"),
        meta: {
          pageTitle: "gradelist",
          breadcrumbs: ["masters", "roles"],
          roles: [UserRole.admin]
        },
      },
      {
        path: "/masters/category",
        name: "category",
        component: () => import("@/views/dashboard/category.vue"),
        meta: {
          pageTitle: "categorylist",
          breadcrumbs: ["masters", "natureb"],
          roles: [UserRole.admin]
        },
      },
      {
        path: "/editcategory/:id",
        name: "editcategory",
        props : true,
        component: () => import("@/views/dashboard/editcategory.vue"),
        meta: {
          pageTitle: "categorylist",
          breadcrumbs: ["masters", "natureb"],
          roles: [UserRole.admin]
        },
      },
      {
        path: "/editunitstype/:id",
        name: "editunitstype",
        props : true,
        component: () => import("@/views/dashboard/editUnitstypes.vue"),
        meta: {
          pageTitle: "listunittypes",
          breadcrumbs: ["masters", "Unitestypes"],
          roles: [UserRole.admin]
        },
      },
      {
        path: "/apps/applications/Contractor_ratios",
        name: "Contractor_ratios",
        component: () => import("@/views/apps/applications/Contractors_ratios.vue"),
        meta: {
          pageTitle: "percentagecontractor",
          breadcrumbs: ["Applications", "Contractor_ratios"],
          roles: [UserRole.dashboard] 
        },
      },
      {
        path: "/apps/applications/todo",
        name: "todolist",
        component: () => import("@/views/apps/applications/Todo.vue"),
        meta: {
          pageTitle: "todolist",
          breadcrumbs: ["Applications", "todolist"],
          roles: [UserRole.tasks] 
        },
      },
      {
        path: "/usertodo/:id",
        name: "usertodo",
        props : true,
        component: () => import("@/views/apps/applications/usertodo.vue"),
        meta: {
          pageTitle: "UserTodo",
          breadcrumbs: ["Applications", "usertodo"],
          roles: [UserRole.tasks]
        },
      },
      {
        path: "/apps/applications/survey",
        name: "survey",
        component: () => import("@/views/apps/applications/Survey.vue"),
        meta: {
          pageTitle: "surveyt",
          breadcrumbs: ["Applications", "surveyt"],
          roles: [UserRole.create_tamplate] 
        },
      },
      {
        path: "/apps/applications/surveylist",
        name: "SurveyList",
        component: () => import("@/views/apps/applications/SurveyList.vue"),
        meta: {
          pageTitle: "surveyt",
          breadcrumbs: ["Applications", "surveyt"],
          roles: [UserRole.add_asnwers]
        },
      },
      {
        path: "/surveylist/:id?/:template_id?",
        name: "editlist",
        props : true,
        component: () => import("@/views/apps/applications/Surveyform.vue"),
        meta: {
          pageTitle: "EditList",
          breadcrumbs: ["Applications", "EditList"],
          roles: [UserRole.add_asnwers]
        },
      },
      {
        path: "/survey/:id",
        name: "survey-details",
        props : true,
        component: () => import("@/views/apps/applications/SurveyDetail.vue"),
        meta: {
          pageTitle: "details",
          breadcrumbs: ["Applications", "surveyt"],
          roles: [UserRole.create_tamplate]
        },
      },
      {
        path: "/masters/units/:id?",
        name: "units",
        props : true,
        component: () => import("@/views/dashboard/units.vue"),
        meta: {
          pageTitle: "unitregistrationform",
          breadcrumbs: ["masters", "Units"],
          roles: [UserRole.admin]
        },
      },
      {
        path: "/masters/register",
        name: "register",
        props : true,
        component: () => import("@/views/dashboard/registerclients.vue"),
        meta: {
          pageTitle: "userregistrations",
          breadcrumbs: ["masters", "register"],
          roles: [UserRole.admin]
        },
      },
      {
        path: "/masters/industrytype",
        name: "kt-industry_type",
        props : true,
        component: () => import("@/views/masters/industrytype.vue"),
        meta: {
          pageTitle: "industrytype",
          breadcrumbs: ["dashboard", "masters"],
          roles: [UserRole.admin]

        },
      },
      {
        path: "/editindustrytype/:id",
        name: "editindustrytype",
        props : true,
        component: () => import("@/views/masters/EditIndustryType.vue"),
        meta: {
          pageTitle: "industrytype",
          breadcrumbs: ["dashboard", "masters"],
          roles: [UserRole.admin]
        },
      },
      {
        path: "/masters/inspectiontype",
        name: "inspectiontype",
        props : true,
        component: () => import("@/views/masters/inspectiontype.vue"),
        meta: {
          pageTitle: "inspectiontype",
          breadcrumbs: ["dashboard", "masters"],
          roles: [UserRole.admin]
        },
      },
      {
        path: "/editinspectiontype/:id",
        name: "editinspectiontype",
        props : true,
        component: () => import("@/views/masters/EditInspectionType.vue"),
        meta: {
          pageTitle: "inspectiontype",
          breadcrumbs: ["dashboard", "masters"],
          roles: [UserRole.admin]

        },
      },
      {
        path: "/masters/inspectionpropertytype",
        name: "inspectionpropertytype",
        props : true,
        component: () => import("@/views/masters/inspectionpropertytype.vue"),
        meta: {
          pageTitle: "inspectionpropertytype",
          breadcrumbs: ["dashboard", "masters"],
          roles: [UserRole.admin]
        },
      },
      {
        path: "/editinspectionproperty/:id",
        name: "editinspectionproperty",
        props : true,
        component: () => import("@/views/masters/editInspectionproperty.vue"),
        meta: {
          pageTitle: "inspectionpropertytype",
          breadcrumbs: ["dashboard", "masters"],
          roles: [UserRole.admin]
        },
      },
      {
        path: "/masters/propertytype",
        name: "propertytype",
        props : true,
        component: () => import("@/views/masters/propertytype.vue"),
        meta: {
          pageTitle: "propertytype",
          breadcrumbs: ["dashboard", "masters"],
          roles: [UserRole.admin]
        },
      },
      {
        path: "/editpropertytype/:id",
        name: "editpropertytype",
        props : true,
        component: () => import("@/views/masters/editpropertytype.vue"),
        meta: {
          pageTitle: "propertytype",
          breadcrumbs: ["dashboard", "masters"],
          roles: [UserRole.admin]
        },
      },
      {
        path: "/masters/registeredproperty",
        name: "registeredproperty",
        props : true,
        component: () => import("@/views/masters/registeredproperty.vue"),
        meta: {
          pageTitle: "registeredproperty",
          breadcrumbs: ["dashboard", "masters"],
          roles: [UserRole.admin]
        },
      },
      {
        path: "/editregisteredproperty/:id",
        name: "editregisteredproperty",
        props : true,
        component: () => import("@/views/masters/editRegisteredProperty.vue"),
        meta: {
          pageTitle: "registeredproperty",
          breadcrumbs: ["dashboard", "masters"],
          roles: [UserRole.admin]
        },
      },
      // {
      //   path: "/crafted/modals/general/invite-friends",
      //   name: "modals-general-invite-friends",
      //   component: () =>
      //     import("@/views/crafted/modals/general/InviteFriends.vue"),
      //   meta: {
      //     pageTitle: "Invite Friends",
      //     breadcrumbs: ["Crafted", "Modals", "General"],
      //   },
      // },
      // {
      //   path: "/crafted/modals/general/view-user",
      //   name: "modals-general-view-user",
      //   component: () => import("@/views/crafted/modals/general/ViewUsers.vue"),
      //   meta: {
      //     pageTitle: "View User",
      //     breadcrumbs: ["Crafted", "Modals", "General"],
      //   },
      // },
      // {
      //   path: "/crafted/modals/general/upgrade-plan",
      //   name: "modals-general-upgrade-plan",
      //   component: () =>
      //     import("@/views/crafted/modals/general/UpgradePlan.vue"),
      //   meta: {
      //     pageTitle: "Upgrade Plan",
      //     breadcrumbs: ["Crafted", "Modals", "General"],
      //   },
      // },
      // {
      //   path: "/crafted/modals/general/share-and-earn",
      //   name: "modals-general-share-and-earn",
      //   component: () =>
      //     import("@/views/crafted/modals/general/ShareAndEarn.vue"),
      //   meta: {
      //     pageTitle: "Share And Earn",
      //     breadcrumbs: ["Crafted", "Modals", "General"],
      //   },
      // },
      // {
      //   path: "/crafted/modals/forms/new-target",
      //   name: "modals-forms-new-target",
      //   component: () => import("@/views/crafted/modals/forms/NewTarget.vue"),
      //   meta: {
      //     pageTitle: "New Target",
      //     breadcrumbs: ["Crafted", "Modals", "Forms"],
      //   },
      // },
      // {
      //   path: "/crafted/modals/forms/new-card",
      //   name: "modals-forms-new-card",
      //   component: () => import("@/views/crafted/modals/forms/NewCard.vue"),
      //   meta: {
      //     pageTitle: "New Card",
      //     breadcrumbs: ["Crafted", "Modals", "Forms"],
      //   },
      // },
      // {
      //   path: "/crafted/modals/forms/new-address",
      //   name: "modals-forms-new-address",
      //   component: () => import("@/views/crafted/modals/forms/NewAddress.vue"),
      //   meta: {
      //     pageTitle: "New Address",
      //     breadcrumbs: ["Crafted", "Modals", "Forms"],
      //   },
      // },
      // {
      //   path: "/crafted/modals/forms/create-api-key",
      //   name: "modals-forms-create-api-key",
      //   component: () =>
      //     import("@/views/crafted/modals/forms/CreateApiKey.vue"),
      //   meta: {
      //     pageTitle: "Create Api Key",
      //     breadcrumbs: ["Crafted", "Modals", "Forms"],
      //   },
      // },
      // {
      //   path: "/crafted/modals/wizards/two-factor-auth",
      //   name: "modals-wizards-two-factor-auth",
      //   component: () =>
      //     import("@/views/crafted/modals/wizards/TwoFactorAuth.vue"),
      //   meta: {
      //     pageTitle: "Two Factory Auth",
      //     breadcrumbs: ["Crafted", "Modals", "Wizards"],
      //   },
      // },
      // {
      //   path: "/crafted/modals/wizards/create-app",
      //   name: "modals-wizards-create-app",
      //   component: () => import("@/views/crafted/modals/wizards/CreateApp.vue"),
      //   meta: {
      //     pageTitle: "Create App",
      //     breadcrumbs: ["Crafted", "Modals", "Wizards"],
      //   },
      // },
      // {
      //   path: "/crafted/modals/wizards/create-account",
      //   name: "modals-wizards-create-account",
      //   component: () =>
      //     import("@/views/crafted/modals/wizards/CreateAccount.vue"),
      //   meta: {
      //     pageTitle: "Create Account",
      //     breadcrumbs: ["Crafted", "Modals", "Wizards"],
      //   },
      // },
      // {
      //   path: "/crafted/widgets/lists",
      //   name: "widgets-list",
      //   component: () => import("@/views/crafted/widgets/Lists.vue"),
      //   meta: {
      //     pageTitle: "Lists",
      //     breadcrumbs: ["Crafted", "Widgets"],
      //   },
      // },
      // {
      //   path: "/crafted/widgets/statistics",
      //   name: "widgets-statistics",
      //   component: () => import("@/views/crafted/widgets/Statistics.vue"),
      //   meta: {
      //     pageTitle: "Statistics",
      //     breadcrumbs: ["Crafted", "Widgets"],
      //   },
      // },
      // {
      //   path: "/crafted/widgets/charts",
      //   name: "widgets-charts",
      //   component: () => import("@/views/crafted/widgets/Charts.vue"),
      //   meta: {
      //     pageTitle: "Charts",
      //     breadcrumbs: ["Crafted", "Widgets"],
      //   },
      // },
      // {
      //   path: "/crafted/widgets/mixed",
      //   name: "widgets-mixed",
      //   component: () => import("@/views/crafted/widgets/Mixed.vue"),
      //   meta: {
      //     pageTitle: "Mixed",
      //     breadcrumbs: ["Crafted", "Widgets"],
      //   },
      // },
      // {
      //   path: "/crafted/widgets/tables",
      //   name: "widgets-tables",
      //   component: () => import("@/views/crafted/widgets/Tables.vue"),
      //   meta: {
      //     pageTitle: "Tables",
      //     breadcrumbs: ["Crafted", "Widgets"],
      //   },
      // },
      {
        path: "/crafted/widgets/feeds",
        name: "widgets-feeds",
        component: () => import("@/views/crafted/widgets/Feeds.vue"),
        meta: {
          pageTitle: "Feeds",
          breadcrumbs: ["Crafted", "Widgets"],
        },
      },
    ],
  },
  {
    path: "/",
    component: () => import("@/layouts/AuthLayout.vue"),
    children: [
      {
        path: "/sign-in",
        name: "sign-in",
        component: () =>
          import("@/views/crafted/authentication/basic-flow/SignIn.vue"),
        meta: {
          pageTitle: "Sign In",
        },
      },
      {
        path: "/sign-up",
        name: "sign-up",
        component: () =>
          import("@/views/crafted/authentication/basic-flow/SignUp.vue"),
        meta: {
          pageTitle: "Sign Up",
        },
      },
      {
        path: "/password-reset",
        name: "password-reset",
        component: () =>
          import("@/views/crafted/authentication/basic-flow/PasswordReset.vue"),
        meta: {
          pageTitle: "Password reset",
        },
      },
      
    ],
  },
  {
    path: "/multi-step-sign-up",
    name: "multi-step-sign-up",
    component: () =>
      import("@/views/crafted/authentication/MultiStepSignUp.vue"),
    meta: {
      pageTitle: "Multi-step Sign up",
    },
  },
  {
    path: "/",
    component: () => import("@/layouts/SystemLayout.vue"),
    children: [
      {
        // the 404 route, when none of the above matches
        path: "/404",
        name: "404",
        component: () => import("@/views/crafted/authentication/Error404.vue"),
        meta: {
          pageTitle: "Error 404",
        },
      },
      {
        path: "/500",
        name: "500",
        component: () => import("@/views/crafted/authentication/Error500.vue"),
        meta: {
          pageTitle: "Error 500",
        },
      },
    ],
  },
  {
    path: "/:pathMatch(.*)*",
    redirect: "/404",
  },
 
];

const router = createRouter({
  // history: createWebHashHistory(),
  history:createWebHistory(),
  routes,
});

router.beforeEach(AuthGuard);

// router.beforeEach((to, from, next) => {
//   const authStore = useAuthStore();
//   const configStore = useConfigStore();

//   // current page view title
//   document.title = `${to.meta.pageTitle} - ${import.meta.env.VITE_APP_NAME}`;

//   // reset config to initial state
//   configStore.resetLayoutConfig();
//   const publicPages = ['/signin', '/signup'];
//   const authRequired = !publicPages.includes(to.path);
//   // verify auth token before each page change
//   // authStore.verifyAuth();
//   const loggedIn = localStorage.getItem('access_token');
//   // before page access check if page requires authentication
//   if (to.meta.middleware == "auth" && authRequired && !loggedIn) {
//     return next({ name: "sign-in" });
//   }
//   next();
//   // if (to.meta.middleware == "auth") {
//   //   if (authStore.isAuthenticated == true || authStore.user!=null) {
  
//   //       next();
  
//   //   } else {
//   //     next({ name: "sign-in" });
//   //   }
//   // } else {
//   //   if(localStorage.getItem('access_token')!==null)
//   //   {
//   //     next('/dashboard')
//   //   }
//   //   next()
//   // }

//   // Scroll page to top on every route change
//   window.scrollTo({
//     top: 0,
//     left: 0,
//     behavior: "smooth",
//   });
// });

export default router;

