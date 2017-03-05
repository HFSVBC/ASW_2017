/* tslint:disable:no-unused-variable */

import { TestBed, async, inject } from '@angular/core/testing';
import { ConectService } from './conect.service';

describe('ConectService', () => {
  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [ConectService]
    });
  });

  it('should ...', inject([ConectService], (service: ConectService) => {
    expect(service).toBeTruthy();
  }));
});
