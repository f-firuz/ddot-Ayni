@extends('layouts.admin')
@section('content')

<div class="" style="display: flex;
flex-direction: row-reverse;
justify-content: space-evenly;
">

    <div class="card shadow p-3 mb-5 bg-body-tertiary rounded col-xl-5">
        @if(request()->has('student'))
        <div class="card-header" style="color: #ff6a00; font-weight: bold ; background-color:white;">
            Добавить студента.
        </div>
        @else
        <div class="card-header" style="color: #ff6a00; font-weight: bold ; background-color:white;">
            {{ trans('global.create') }} {{ trans('cruds.user.title_singular') }}
        </div>

        @endif

        <div class="card-body">
            <form method="POST" action="{{ route("admin.users.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                    @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                </div>
                @if(request()->has('student'))
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.user.fields.facultet') }}</label>
                    <select class="form-control select2 {{ $errors->has('class') ? 'is-invalid' : '' }}" name="id_facultet " id="id_facultet ">
                        @foreach($classes as $id => $class)
                        <option value="{{ $id }}" {{ old('id_facultet ') == $id ? 'selected' : '' }}>{{ $class }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('class'))
                    <div class="invalid-feedback">
                        {{ $errors->first('class') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.class_id_helper') }}</span>
                </div>


                <div class="form-group">
                    <label for="class_id">Специальносты</label>
                    <select class="form-control select2 {{ $errors->has('class') ? 'is-invalid' : '' }}" name="class_id" id="class_id">
                        @foreach($classes as $id => $class)
                        <option value="{{ $id }}" {{ old('class_id') == $id ? 'selected' : '' }}>{{ $class }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('class'))
                    <div class="invalid-feedback">
                        {{ $errors->first('class') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.class_id_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="id_cours ">{{ trans('cruds.user.fields.cours') }}</label>
                    <input class="form-control " type="text" name="id_cours " id="id_cours " value="{{ old('id_cours ', '') }}" required>
                    <span class="help-block">{{ trans('cruds.user.fields.cours_helper') }}</span>
                </div>
                @endif
                <div class="form-group">
                    <label class="required" for="phone">{{ trans('cruds.user.fields.phone') }}</label>
                    <input class="form-control " type="text" name="phone" id="phone" required>
                    <span class="help-block">{{ trans('cruds.user.fields.phone_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email') }}" required>
                    @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                </div>


                <div class="form-group">
                    <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                    <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password" required>
                    @if($errors->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                </div>
                @if(!request()->has('student'))
                <div class="form-group">
                    <label class="required" for="roles">{{ trans('cruds.user.fields.roles') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]" id="roles" multiple required>
                        @foreach($roles as $id => $roles)
                        <option value="{{ $id }}" {{ in_array($id, old('roles', [])) ? 'selected' : '' }}>{{ $roles }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('roles'))
                    <div class="invalid-feedback">
                        {{ $errors->first('roles') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
                </div>
                @else
                <input type="hidden" name="roles[]" value="4">
                @endif

                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection