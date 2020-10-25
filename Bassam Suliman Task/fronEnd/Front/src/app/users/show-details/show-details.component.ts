import { Component, OnInit, AfterViewInit } from '@angular/core';

import {ShowService} from 'src/app/show.service'

import { ActivatedRoute } from '@angular/router'; 

@Component({
  selector: 'app-show-details',
  templateUrl: './show-details.component.html',
  styleUrls: ['./show-details.component.css']
})
export class ShowDetailsComponent implements OnInit , AfterViewInit {  
  ngAfterViewInit(): void {  
}  

 prd: any = null;
  constructor(private service:ShowService, public activatedRoute: ActivatedRoute  ) { }
  userDetails:any;
  userad:any;
  ngOnInit(): void {
    this.activatedRoute.params.subscribe(param => {  
      // tslint:disable-next-line: no-string-literal  
      this.prd =param['id'];
      this.getUserDetails(this.prd);
    });
  }

  getUserDetails(val:any){
    
    this.service.showUser_Details(val).subscribe(data=>{
      this.userDetails=data['data'];
      this.userad=data['ad'];
      
     
    });
    
  }

}
