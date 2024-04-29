# prntScavenger
Website that let's you find random prnt.sc screenshots.

## What?
Prnt.sc is a site that lets you upload screenshots so you can share them with a short link. The link is so short and there is so many screenshots that it's easy to put six random numbers and letters and find someones screenshot. So this became a trend and I decided to make a site that let's you do this faster.

PrntScavenger is open-source so feel free to host it.

## Info
- Uses hQuery library to scrape images and echo the content so it doesn't get blocked by cors.
- Caches images for faster loading.
- Very minimal so can hold alot of traffic.

## Running with Docker
- Install docker and run with
```docker run -p 127.0.0.1:5000:5000 3nd3r1/prnt-scavenger```
- Open your browser and go to http://localhost:5000
