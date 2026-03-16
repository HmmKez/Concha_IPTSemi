<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::latest()->paginate(10);
        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name'       => 'required|string|max:255',
            'last_name'        => 'required|string|max:255',
            'email'            => 'required|email|unique:members,email',
            'phone'            => 'nullable|string|max:20',
            'address'          => 'nullable|string|max:1000',
            'membership_start' => 'required|date',
            'membership_end'   => 'required|date|after_or_equal:membership_start',
        ]);

        Member::create($request->all());

        return redirect()->route('members.index')->with('success', 'Member added successfully.');
    }

    public function show(Member $member)
    {
        $loans = $member->loans()->with('loanItems.book')->latest()->paginate(5);
        return view('members.show', compact('member', 'loans'));
    }

    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $request->validate([
            'first_name'       => 'required|string|max:255',
            'last_name'        => 'required|string|max:255',
            'email'            => 'required|email|unique:members,email,' . $member->id,
            'phone'            => 'nullable|string|max:20',
            'address'          => 'nullable|string|max:1000',
            'membership_start' => 'required|date',
            'membership_end'   => 'required|date|after_or_equal:membership_start',
        ]);

        $member->update($request->all());

        return redirect()->route('members.index')->with('success', 'Member updated successfully.');
    }

    public function destroy(Member $member)
    {
        if ($member->loans()->count() > 0) {
            return redirect()->route('members.index')->with('error', 'Cannot delete member with existing loans.');
        }

        $member->delete();
        return redirect()->route('members.index')->with('success', 'Member deleted successfully.');
    }
}