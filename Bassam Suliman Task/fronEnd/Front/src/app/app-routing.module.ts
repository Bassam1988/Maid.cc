import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import {UsersComponent} from'./users/users.component'
import {ShowDetailsComponent} from'./users/show-details/show-details.component'

const routes: Routes = [
  {path:'Details/:id', component:ShowDetailsComponent},
  {path:'', component:UsersComponent}
  
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
