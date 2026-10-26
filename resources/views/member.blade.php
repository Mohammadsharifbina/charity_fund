@extends("layout.master")
@section("content")


<button class="btn" onclick="window.location.href='{{ route('member.create') }}'">＋ Add Member</button>


<h2>Members Information</h2>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>last name</th>
                <th>phone</th>
                <th>Status</th>
                <th>edit</th>
                <th>delete</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($members as $member)

            <tr onclick="window.location='{{ url('memberInfo/' . $member->id) }}'" style=" cursor: pointer;">

                <td>
                    <div class="avatar"> @if ($member->image && file_exists(public_path('students/' .
                        $member->image)))
                        <img src="{{ asset('students/' . $member->image) }}" alt="{{ $member->name }}">
                        @else
                        <span>
                            {{ strtoupper(substr($member->name ?? 'U', 0, 1)) }}
                        </span>
                        @endif
                    </div>
                </td>
                <!-- <td><img id="profile-image" src="{{ asset('students/' . $member->image) }}" alt="" width="30"
                        height="30" style="object-fit: cover; border-radius: 50%; transition: transform 0.3s ease;
    cursor: pointer;"></td> -->
                <td>{{ $member->name }}</td>
                <td>{{ $member->last_name }}</td>
                <td>{{ $member->phone }}</td>
                <td>{{ $member->status }}</td>
                <td><a href="/member/{{$member->id}}/edit"><i class="fa-solid fa-pen"></i></a></td>
                <td>
                    <a href="/deleteMember/{{ $member->id }}"><i class="fa-solid fa-trash"></i></a>
                </td>

            </tr>
            </a>
            @endforeach
        </tbody>
    </table>
</div>


@endsection