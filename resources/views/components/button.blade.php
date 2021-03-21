<{{ $buttonType=="anchor"? "a" : "button" }}
    class="btn btn-{{ $type }} mr-1"
   {{ $name?"name=$name": "" }}
   {{ $id?"name=$id": "" }}
    {{ $buttonType=="anchor"? "href" : "formaction" }}="{{ $target }}">
        {{ $displayedName }}
</{{ $buttonType=="anchor"? "a" : "button" }}>
