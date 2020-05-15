import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { RegisterComponent, LoginComponent, 
	ForgotPasswordComponent, ResetPasswordComponent } from './_components/auth/index';
import { HomeComponent } from './_components/home/home.component';
import { CartComponent } from './_components/cart/cart.component';
import { AuthGuard } from './_guards/auth.guard';
const routes: Routes = [
   { path: 'login', component: LoginComponent },
    { path: 'register', component: RegisterComponent },
    { path: 'forgot-password', component: ForgotPasswordComponent },
    { path: 'reset-password/:token', component: ResetPasswordComponent },
    { path: 'home', component: HomeComponent, canActivate: [AuthGuard]  },
     { path: 'cart', component: CartComponent, canActivate: [AuthGuard]  },
    { path: '**', redirectTo: 'home' }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }

