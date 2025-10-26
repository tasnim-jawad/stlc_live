# PropertySlider Component

An optimized Vue 3 slider component using Swiper.js with modern features and accessibility improvements.

## Features

### 🚀 Performance Optimizations

- **Vue 3 Composition API**: Modern reactive architecture
- **Lazy Loading**: Images load only when needed
- **Memory Management**: Proper cleanup of Swiper instances
- **Efficient Rendering**: Minimal re-renders with proper keys

### ♿ Accessibility Improvements

- **ARIA Labels**: Screen reader friendly navigation
- **Keyboard Navigation**: Full keyboard support
- **Focus Management**: Proper focus indicators
- **High Contrast**: Support for high contrast mode
- **Reduced Motion**: Respects user motion preferences

### 🎨 Modern Features

- **Responsive Design**: Mobile-first approach
- **Touch Gestures**: Smooth touch interactions
- **Loading States**: Visual feedback during image loading
- **Error Handling**: Graceful degradation
- **TypeScript Ready**: Full type support (if needed)

## Usage

### Basic Usage

```vue
<template>
  <PropertySlider :slides="propertySlides" />
</template>

<script setup>
import PropertySlider from "@/components/PropertySlider.vue";

const propertySlides = [
  {
    id: 1,
    title: "Beautiful Property Title",
    link: "/property/1",
    image: "https://example.com/image.jpg",
    author: {
      name: "John Doe",
      avatar: "https://example.com/avatar.jpg",
      profile: "/author/1",
    },
    commentsCount: 5,
    category: {
      name: "Luxury",
      link: "/category/luxury",
    },
    date: "2024-01-15",
  },
  // ... more slides
];
</script>
```

### Advanced Usage with Props

```vue
<template>
  <PropertySlider
    :slides="propertySlides"
    :show-navigation="true"
    :autoplay="true"
    :autoplay-delay="5000"
  />
</template>
```

## Props

| Prop             | Type    | Default | Description                    |
| ---------------- | ------- | ------- | ------------------------------ |
| `slides`         | Array   | `[]`    | Array of slide objects         |
| `showNavigation` | Boolean | `true`  | Show/hide navigation buttons   |
| `autoplay`       | Boolean | `false` | Enable autoplay                |
| `autoplayDelay`  | Number  | `3000`  | Autoplay delay in milliseconds |

## Slide Object Structure

```typescript
interface Slide {
  id: number | string;
  title: string;
  link: string;
  image: string;
  author: {
    name: string;
    avatar: string;
    profile: string;
  };
  commentsCount: number;
  category: {
    name: string;
    link: string;
  };
  date: string; // ISO date format
}
```

## Styling

The component uses scoped SCSS with CSS custom properties for easy theming:

```scss
.property-slider-container {
  --primary-color: #ef233c;
  --primary-hover: #d90429;
  --background-color: #2b2d42;
  --text-color: #edf2f4;
  --text-muted: #8d99ae;
}
```

## Browser Support

- Modern browsers (ES2017+)
- IE11+ (with polyfills)
- iOS Safari 12+
- Android Chrome 70+

## Dependencies

- Vue 3.0+
- Swiper 8.0+
- Font Awesome (for icons)

## Performance Tips

1. **Image Optimization**: Use optimized images with appropriate dimensions
2. **Lazy Loading**: Images load automatically with `loading="lazy"`
3. **Memory Management**: Component automatically cleans up on unmount
4. **Responsive Images**: Consider using `srcset` for different screen sizes

## Customization

### Custom Breakpoints

The component uses responsive breakpoints that can be customized in the SCSS:

```scss
@media (min-width: 768px) {
  /* Tablet styles */
}
@media (min-width: 1024px) {
  /* Desktop styles */
}
@media (min-width: 1440px) {
  /* Large desktop styles */
}
```

### Animation Customization

Parallax and transition timings can be adjusted:

```vue
<div
  data-swiper-parallax-y="-240"
  data-swiper-parallax-duration="700"
>
```

## Troubleshooting

### Common Issues

1. **Swiper not initializing**: Ensure DOM is fully rendered before initialization
2. **Images not loading**: Check image URLs and CORS settings
3. **Navigation not working**: Verify navigation elements exist in DOM

### Debug Mode

Add this to enable debug logging:

```javascript
// In component setup
if (process.env.NODE_ENV === "development") {
  console.log("PropertySlider initialized with", props.slides.length, "slides");
}
```

## Migration from Old Version

### Key Changes

1. **Vue 3 Composition API**: Update from Options API
2. **New Props Structure**: Use new slide object format
3. **CSS Classes**: Updated class names for better semantics
4. **Router Links**: Uses `router-link` instead of anchor tags

### Migration Steps

1. Update Vue to version 3+
2. Install latest Swiper version
3. Update slide data structure
4. Replace old component usage
5. Update any custom CSS overrides

## Contributing

When contributing to this component:

1. Follow Vue 3 best practices
2. Maintain accessibility standards
3. Add unit tests for new features
4. Update documentation
5. Ensure responsive design works

## License

This component is part of the STLC Live project.
