import { Component, OnInit } from '@angular/core';

import {ShowService} from 'src/app/show.service'

import { Router } from '@angular/router';
@Component({
  selector: 'app-show',
  templateUrl: './show.component.html',
  styleUrls: ['./show.component.css']
})
export class ShowComponent implements OnInit {

  constructor(private service:ShowService,private router: Router) { }

  Users_list:any=[];
  per_page:any;
  total:any;
  total_pages:any;
  arr :any;
  searchText = '';
  ngOnInit(): void {
    this.getUserList()
  }

  getUserList(){
    this.service.showPage(1).subscribe(data=>{
      this.Users_list=data['data'];
      this.per_page=parseInt(data['per_page']);
      this.total=parseInt(data['total']);
      this.total_pages=parseInt(data['total_pages']);
      this.arr=Array(this.total_pages);
    });
  }

  showpage(page_num:any){
    this.service.showPage(page_num).subscribe(data=>{
      this.Users_list=data['data'];
      this.per_page=parseInt(data['per_page']);
      this.total=parseInt(data['total']);
      this.total_pages=parseInt(data['total_pages']);
      this.arr=Array(this.total_pages);
    });
  }
  
  getUserDetails(val:any){
    /*this.service.showPage(1).subscribe(data=>{
      this.Users_list=data['data'];
      this.per_page=parseInt(data['per_page']);
      this.total=parseInt(data['total']);
      this.total_pages=parseInt(data['total_pages']);
    });*/
    alert (val)
  }
  public gotoProductDetails(url, id) {
    
    this.router.navigate([url, id]).then( (e) => {
      if (e) {
        console.log("Navigation is successful!");
      } else {
        console.log("Navigation has failed!");
      }
    });
}

}
