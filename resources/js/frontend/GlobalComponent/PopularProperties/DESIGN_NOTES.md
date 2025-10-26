# PropertySlider Navigation Button Design

## Updated Design (Based on Screenshot)

The navigation buttons have been redesigned to match the modern vertical slider navigation pattern shown in the reference image.

### Key Design Features

#### 1. **Vertical Text Orientation**

- Uses `writing-mode: vertical-rl` for vertical text display
- Text reads from top to bottom on both sides
- "PREV" on the left side, "NEXT" on the right side

#### 2. **Full Height Buttons**

- Buttons span the full height of the thumbnail slider
- Positioned on the far left and far right edges
- Semi-transparent background for visibility without obscuring content

#### 3. **Visual Styling**

- **Default State**: Semi-transparent dark background `rgba(43, 45, 66, 0.8)`
- **Hover State**: Red highlight background `rgba(239, 35, 60, 0.9)`
- **Active State**: Darker red `rgba(217, 4, 41, 0.95)`
- Border accent on inner edge (left border for NEXT, right border for PREV)

#### 4. **Typography**

- Uppercase text for better readability
- Letter spacing: 2px for clarity
- Font size scales responsively:
  - Mobile: Hidden (only show on tablet+)
  - Tablet (768px+): 12px
  - Desktop (1024px+): 14px

#### 5. **Icon Placement**

- Arrow icons positioned above/below text
- Horizontal orientation for arrows (not rotated)
- Icons provide visual direction cues

### Responsive Behavior

```scss
// Mobile (< 768px)
.thumb-navi-wrap {
  display: none; // Hidden on mobile to save space
}

// Tablet (≥ 768px)
.thumb-navi-wrap {
  display: block;
  .nav-button {
    font-size: 12px;
    padding: 15px 6px;
  }
}

// Desktop (≥ 1024px)
.thumb-navi-wrap {
  .nav-button {
    font-size: 14px;
    padding: 20px 8px;
  }
}
```

### Accessibility Features

1. **ARIA Labels**: Descriptive labels for screen readers
2. **Focus Indicators**: Clear outline when focused via keyboard
3. **Keyboard Support**: Can be activated via Enter/Space keys
4. **Pointer Events**: Properly configured to allow click-through where needed

### Color Scheme

| State   | Background               | Text Color | Border                   |
| ------- | ------------------------ | ---------- | ------------------------ |
| Default | `rgba(43, 45, 66, 0.8)`  | `#edf2f4`  | `rgba(239, 35, 60, 0.5)` |
| Hover   | `rgba(239, 35, 60, 0.9)` | `#fff`     | Same                     |
| Active  | `rgba(217, 4, 41, 0.95)` | `#fff`     | Same                     |

### User Interaction Flow

1. **Hover**: Background changes to red, text becomes white
2. **Click**: Slide transitions to next/previous
3. **Focus**: Outline appears for keyboard navigation
4. **Active**: Slightly darker red for click feedback

### Technical Implementation

The buttons use:

- CSS `writing-mode` for vertical text
- Flexbox for icon/text alignment
- Absolute positioning for fixed placement
- Z-index layering for proper stacking
- Pointer events management for click areas

### Comparison: Old vs New Design

| Feature      | Old Design                 | New Design                |
| ------------ | -------------------------- | ------------------------- |
| Orientation  | Rotated -90deg             | Vertical writing-mode     |
| Position     | Small buttons with margins | Full-height edge buttons  |
| Visibility   | Icons hidden by default    | Always visible            |
| Background   | Transparent                | Semi-transparent dark     |
| Hover Effect | Color change only          | Color + background change |
| Mobile       | Small and hard to tap      | Hidden (swipe enabled)    |

### Performance Considerations

- Uses CSS transforms sparingly (only on active state)
- Transitions limited to color and background
- No JavaScript for button styling
- Reduced motion respected via media query

### Browser Support

- Modern browsers with CSS writing-mode support
- Fallback to horizontal layout in older browsers
- Progressive enhancement approach
