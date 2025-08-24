<div>
    @if($currentStep != 1)
    <div style="display: none" class="row setup-content" id="step-1">
        @endif
        <div>
            <div class="col-xs-12">
                <div class="col-md-12 p-4 bg-light rounded shadow-sm">
                    <br>
                    <div class="form-row">
                        <div class="col">
                            <label for="title" class="font-weight-bold text-primary">{{__('keyworld.email')}}</label>
                            <input type="email" wire:model="Email" class="form-control border-primary">
                            @error('Email')
                            <div class="alert alert-danger mt-1 p-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="title" class="font-weight-bold text-primary">{{__('keyworld.password')}}</label>
                            <input type="password" wire:model="Password" class="form-control border-primary">
                            @error('Password')
                            <div class="alert alert-danger mt-1 p-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row mt-3">
                        <div class="col">
                            <label for="title" class="font-weight-bold text-success">{{__('keyworld.Name_Father')}} AR</label>
                            <input type="text" wire:model="Name_Father" class="form-control border-success">
                            @error('Name_Father')
                            <div class="alert alert-danger mt-1 p-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="title" class="font-weight-bold text-success">{{__('keyworld.Name_Father_en')}}</label>
                            <input type="text" wire:model="Name_Father_en" class="form-control border-success">
                            @error('Name_Father_en')
                            <div class="alert alert-danger mt-1 p-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row mt-3">
                        <div class="col-md-3">
                            <label for="title" class="font-weight-bold text-info">{{__('keyworld.Job_Father')}}</label>
                            <input type="text" wire:model="Job_Father" class="form-control border-info">
                            @error('Job_Father')
                            <div class="alert alert-danger mt-1 p-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="title" class="font-weight-bold text-info">{{__('keyworld.Job_Father_en')}}</label>
                            <input type="text" wire:model="Job_Father_en" class="form-control border-info">
                            @error('Job_Father_en')
                            <div class="alert alert-danger mt-1 p-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col">
                            <label for="title" class="font-weight-bold text-warning">{{__('keyworld.National_ID_Father')}}</label>
                            <input type="text" wire:model="National_ID_Father" class="form-control border-warning">
                            @error('National_ID_Father')
                            <div class="alert alert-danger mt-1 p-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="title" class="font-weight-bold text-warning">{{__('keyworld.Passport_ID_Father')}}</label>
                            <input type="text" wire:model="Passport_ID_Father" class="form-control border-warning">
                            @error('Passport_ID_Father')
                            <div class="alert alert-danger mt-1 p-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col">
                            <label for="title" class="font-weight-bold text-danger">{{__('keyworld.Phone_Father')}}</label>
                            <input type="text" wire:model="Phone_Father" class="form-control border-danger">
                            @error('Phone_Father')
                            <div class="alert alert-danger mt-1 p-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row mt-3">
                        <div class="form-group col-md-6">
                            <label for="inputCity" class="font-weight-bold text-primary">{{__('keyworld.Nationality_Father_id')}}</label>
                            <select class="custom-select border-primary" wire:model="Nationality_Father_id">
                                <option selected>{{__('keyworld.Choose')}}...</option>
                                @foreach($Nationalities as $National)
                                <option value="{{$National->id}}">{{$National->name_ar}}</option>
                                @endforeach
                            </select>
                            @error('Nationality_Father_id')
                            <div class="alert alert-danger mt-1 p-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col">
                            <label for="inputState" class="font-weight-bold text-success">
                                {{ __('keyworld.Blood_Type_Father_id') }}
                            </label>

                            <select class="custom-select border-primary" wire:model="Blood_Type_Father_id">
                                <option selected>
                                    {{ __('keyworld.Choose') }}...
                                </option>
                                @foreach($Type_Bloods as $Type_Blood)
                                <option value="{{ $Type_Blood->id }}">
                                    {{ $Type_Blood->type }}
                                </option>
                                @endforeach
                            </select>



                            @error('Blood_Type_Father_id')
                            <div class="alert alert-danger mt-1 p-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col">
                            <label for="inputZip" class="font-weight-bold text-info">{{__('keyworld.Religion_Father_id')}}</label>
                            <select class="custom-select border-info" wire:model="Religion_Father_id">
                                <option selected>{{ __('keyworld.Choose') }}...</option>
                                @foreach($Religions as $Religion)
                                <option value="{{$Religion->id}}">{{$Religion->name_ar}}</option>
                                @endforeach
                            </select>
                            @error('Religion_Father_id')
                            <div class="alert alert-danger mt-1 p-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <label for="exampleFormControlTextarea1" class="font-weight-bold text-secondary">{{__('keyworld.Address_Father')}}</label>
                        <textarea class="form-control border-secondary" wire:model="Address_Father" id="exampleFormControlTextarea1" rows="4"></textarea>
                        @error('Address_Father')
                        <div class="alert alert-danger mt-1 p-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <button class="btn btn-success btn-lg float-right shadow" wire:click="firstStepSubmit" type="button">
                        {{__('keyworld.Next')}}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>