<?php

namespace shiraishi\Http\Requests;

use Illuminate\Validation\Rule;
use kaede\Repositories\RoleRepository;
use Illuminate\Foundation\Http\FormRequest;
use tsumugi\Repositories\RoleRepository;

class UserRequest extends FormRequest
{
    /**
     * @var \tsumugi\Repositories\RoleRepository
     */
    protected $roleRepository;

    /**
     * @var array
     */
    protected $availableRoles;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->availableRoles = $this->roleRepository->getAvailableRoles();
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'    => 'required|string|max:150',
            'email'   => 'required|email',
            'contact' => 'required|max:16',
            'roles'   => 'required|array',
            'roles.*' => [
                'required',
                'min:1',
                Rule::in($this->availableRoles),
            ],
        ];
    }
}
