<div class="pagetitle">
    <h1>{{ $title }}</h1>
    <nav>
        <ol class="breadcrumb">
            @if (Auth::user()->is_employe)
                <li class="breadcrumb-item"><a href="{{ route('app.dossier.employe') }}">Mon dossier</a></li>
            @else
                <li class="breadcrumb-item"><a href="{{ route('app.home') }}">Tableau de bord</a></li>
            @endif
            @foreach ($items as $item)
                @if ($item->link)
                    <li class="breadcrumb-item @if ($loop->last) active @endif"><a
                            href="{{ $item->link }}">{{ $item->label }}</a></li>
                @else
                    <li class="breadcrumb-item @if ($loop->last) active @endif">
                        {{ $item->label }}
                    </li>
                @endif
            @endforeach
        </ol>
    </nav>
</div><!-- End Page Title -->
