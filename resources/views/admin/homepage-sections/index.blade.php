@extends('admin.layout')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold">Homepage Sections</h1>
        <a href="{{ route('admin.homepage-sections.create') }}" class="rounded bg-orange-500 px-4 py-2 text-sm font-medium text-white hover:bg-orange-600">Add Section</a>
    </div>

    <div class="mb-6 rounded-xl border border-amber-200 bg-amber-50 p-4 text-sm text-slate-700">
        <p class="font-semibold text-slate-900">Homepage hero keys</p>
        <p class="mt-1">Use these section keys to edit the facilities hero block on the website:</p>
        <div class="mt-3 grid gap-2 md:grid-cols-2 xl:grid-cols-3">
            <div><code>hero_kicker</code>: small label above the main title</div>
            <div><code>hero</code>: main title and paragraph</div>
            <div><code>hero_primary_cta</code>: button text in <code>title</code>, URL in <code>content</code></div>
            <div><code>hero_secondary_cta</code>: button text in <code>title</code>, URL in <code>content</code></div>
            <div><code>hero_chip_1</code>, <code>hero_chip_2</code>, <code>hero_chip_3</code>: chip labels</div>
            <div><code>about</code>: right-side intro card</div>
            <div><code>hero_highlight_1</code>, <code>hero_highlight_2</code>: stat cards with value in <code>title</code>, label in <code>subtitle</code>, description in <code>content</code></div>
            <div><code>trusted_brands</code>: section heading in <code>title</code>, visibility flag in <code>content</code> using <code>1</code> or <code>true</code> to show</div>
            <div><code>why_us</code>, <code>value_one</code>, <code>value_two</code>: card subtitle, title, description, plus optional background image</div>
            <div><code>process</code>: main heading in <code>title</code>, supporting text in <code>subtitle</code>, small label in <code>content</code></div>
            <div><code>process_step_1</code>, <code>process_step_2</code>, <code>process_step_3</code>: step label in <code>title</code>, step description in <code>content</code></div>
            <div><code>industries</code>: main heading in <code>title</code>, small label in <code>subtitle</code>, one industry per line in <code>content</code></div>
            <div><code>testimonials</code>: one testimonial per line in <code>content</code> using <code>"Quote" | Author</code></div>
            <div><code>request_cta</code>: left-side request area image upload uses the section <code>image</code></div>
            <div><code>walkthrough_cta</code>: right-side contact card with small label in <code>subtitle</code>, heading in <code>title</code>, text in <code>content</code></div>
        </div>
    </div>

    <div class="overflow-hidden rounded-lg bg-white shadow">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-slate-100 text-slate-600">
                <tr>
                    <th class="px-4 py-3">Key</th>
                    <th class="px-4 py-3">Title</th>
                    <th class="px-4 py-3">Subtitle</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sections as $section)
                    <tr class="border-t border-slate-200">
                        <td class="px-4 py-3 font-medium">{{ $section->key }}</td>
                        <td class="px-4 py-3">{{ $section->title }}</td>
                        <td class="px-4 py-3">{{ $section->subtitle }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.homepage-sections.edit', $section) }}" class="text-orange-600 hover:text-orange-700">Edit</a>
                                <form method="POST" action="{{ route('admin.homepage-sections.destroy', $section) }}" onsubmit="return confirm('Delete this section?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-700">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center text-slate-500">No sections found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $sections->links() }}</div>
@endsection
