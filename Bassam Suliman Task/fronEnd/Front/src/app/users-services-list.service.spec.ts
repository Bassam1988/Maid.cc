import { TestBed } from '@angular/core/testing';

import { UsersServicesListService } from './users-services-list.service';

describe('UsersServicesListService', () => {
  let service: UsersServicesListService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(UsersServicesListService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
