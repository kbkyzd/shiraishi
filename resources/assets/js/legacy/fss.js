FSS = {
    FRONT: 0,
    BACK: 1,
    DOUBLE: 2,
    SVGNS: 'http://www.w3.org/2000/svg',
};
FSS.Array = typeof Float32Array === 'function' ? Float32Array : Array;
FSS.Utils = {
    isNumber: function(t) {
        return !isNaN(parseFloat(t)) && isFinite(t);
    },
};
(function() {
    let t = 0;
    let e = ['ms', 'moz', 'webkit', 'o'];
    for (let i = 0; i < e.length && !window.requestAnimationFrame; ++i) {
        window.requestAnimationFrame = window[e[i] + 'RequestAnimationFrame'];
        window.cancelAnimationFrame = window[e[i] + 'CancelAnimationFrame'] || window[e[i] +
        'CancelRequestAnimationFrame'];
    }
    if (!window.requestAnimationFrame) {
        window.requestAnimationFrame = function(e, i) {
            let r = (new Date).getTime();
            let s = Math.max(0, 16 - (r - t));
            let n = window.setTimeout(function() {
                e(r + s);
            }, s);
            t = r + s;
            return n;
        };
    }
    if (!window.cancelAnimationFrame) {
        window.cancelAnimationFrame = function(t) {
            clearTimeout(t);
        };
    }
})();
Math.PIM2 = Math.PI * 2;
Math.PID2 = Math.PI / 2;
Math.randomInRange = function(t, e) {
    return t + (e - t) * Math.random();
};
Math.clamp = function(t, e, i) {
    t = Math.max(t, e);
    t = Math.min(t, i);
    return t;
};
FSS.Vector3 = {
    create: function(t, e, i) {
        let r = new FSS.Array(3);
        this.set(r, t, e, i);
        return r;
    },
    clone: function(t) {
        let e = this.create();
        this.copy(e, t);
        return e;
    },
    set: function(t, e, i, r) {
        t[0] = e || 0;
        t[1] = i || 0;
        t[2] = r || 0;
        return this;
    },
    setX: function(t, e) {
        t[0] = e || 0;
        return this;
    },
    setY: function(t, e) {
        t[1] = e || 0;
        return this;
    },
    setZ: function(t, e) {
        t[2] = e || 0;
        return this;
    },
    copy: function(t, e) {
        t[0] = e[0];
        t[1] = e[1];
        t[2] = e[2];
        return this;
    },
    add: function(t, e) {
        t[0] += e[0];
        t[1] += e[1];
        t[2] += e[2];
        return this;
    },
    addVectors: function(t, e, i) {
        t[0] = e[0] + i[0];
        t[1] = e[1] + i[1];
        t[2] = e[2] + i[2];
        return this;
    },
    addScalar: function(t, e) {
        t[0] += e;
        t[1] += e;
        t[2] += e;
        return this;
    },
    subtract: function(t, e) {
        t[0] -= e[0];
        t[1] -= e[1];
        t[2] -= e[2];
        return this;
    },
    subtractVectors: function(t, e, i) {
        t[0] = e[0] - i[0];
        t[1] = e[1] - i[1];
        t[2] = e[2] - i[2];
        return this;
    },
    subtractScalar: function(t, e) {
        t[0] -= e;
        t[1] -= e;
        t[2] -= e;
        return this;
    },
    multiply: function(t, e) {
        t[0] *= e[0];
        t[1] *= e[1];
        t[2] *= e[2];
        return this;
    },
    multiplyVectors: function(t, e, i) {
        t[0] = e[0] * i[0];
        t[1] = e[1] * i[1];
        t[2] = e[2] * i[2];
        return this;
    },
    multiplyScalar: function(t, e) {
        t[0] *= e;
        t[1] *= e;
        t[2] *= e;
        return this;
    },
    divide: function(t, e) {
        t[0] /= e[0];
        t[1] /= e[1];
        t[2] /= e[2];
        return this;
    },
    divideVectors: function(t, e, i) {
        t[0] = e[0] / i[0];
        t[1] = e[1] / i[1];
        t[2] = e[2] / i[2];
        return this;
    },
    divideScalar: function(t, e) {
        if (e !== 0) {
            t[0] /= e;
            t[1] /= e;
            t[2] /= e;
        } else {
            t[0] = 0;
            t[1] = 0;
            t[2] = 0;
        }
        return this;
    },
    cross: function(t, e) {
        let i = t[0];
        let r = t[1];
        let s = t[2];
        t[0] = r * e[2] - s * e[1];
        t[1] = s * e[0] - i * e[2];
        t[2] = i * e[1] - r * e[0];
        return this;
    },
    crossVectors: function(t, e, i) {
        t[0] = e[1] * i[2] - e[2] * i[1];
        t[1] = e[2] * i[0] - e[0] * i[2];
        t[2] = e[0] * i[1] - e[1] * i[0];
        return this;
    },
    min: function(t, e) {
        if (t[0] < e) {
            t[0] = e;
        }
        if (t[1] < e) {
            t[1] = e;
        }
        if (t[2] < e) {
            t[2] = e;
        }
        return this;
    },
    max: function(t, e) {
        if (t[0] > e) {
            t[0] = e;
        }
        if (t[1] > e) {
            t[1] = e;
        }
        if (t[2] > e) {
            t[2] = e;
        }
        return this;
    },
    clamp: function(t, e, i) {
        this.min(t, e);
        this.max(t, i);
        return this;
    },
    limit: function(t, e, i) {
        let r = this.length(t);
        if (e !== null && r < e) {
            this.setLength(t, e);
        } else if (i !== null && r > i) {
            this.setLength(t, i);
        }
        return this;
    },
    dot: function(t, e) {
        return t[0] * e[0] + t[1] * e[1] + t[2] * e[2];
    },
    normalise: function(t) {
        return this.divideScalar(t, this.length(t));
    },
    negate: function(t) {
        return this.multiplyScalar(t, -1);
    },
    distanceSquared: function(t, e) {
        let i = t[0] - e[0];
        let r = t[1] - e[1];
        let s = t[2] - e[2];
        return i * i + r * r + s * s;
    },
    distance: function(t, e) {
        return Math.sqrt(this.distanceSquared(t, e));
    },
    lengthSquared: function(t) {
        return t[0] * t[0] + t[1] * t[1] + t[2] * t[2];
    },
    length: function(t) {
        return Math.sqrt(this.lengthSquared(t));
    },
    setLength: function(t, e) {
        let i = this.length(t);
        if (i !== 0 && e !== i) {
            this.multiplyScalar(t, e / i);
        }
        return this;
    },
};
FSS.Vector4 = {
    create: function(t, e, i, r) {
        let s = new FSS.Array(4);
        this.set(s, t, e, i);
        return s;
    },
    set: function(t, e, i, r, s) {
        t[0] = e || 0;
        t[1] = i || 0;
        t[2] = r || 0;
        t[3] = s || 0;
        return this;
    },
    setX: function(t, e) {
        t[0] = e || 0;
        return this;
    },
    setY: function(t, e) {
        t[1] = e || 0;
        return this;
    },
    setZ: function(t, e) {
        t[2] = e || 0;
        return this;
    },
    setW: function(t, e) {
        t[3] = e || 0;
        return this;
    },
    add: function(t, e) {
        t[0] += e[0];
        t[1] += e[1];
        t[2] += e[2];
        t[3] += e[3];
        return this;
    },
    multiplyVectors: function(t, e, i) {
        t[0] = e[0] * i[0];
        t[1] = e[1] * i[1];
        t[2] = e[2] * i[2];
        t[3] = e[3] * i[3];
        return this;
    },
    multiplyScalar: function(t, e) {
        t[0] *= e;
        t[1] *= e;
        t[2] *= e;
        t[3] *= e;
        return this;
    },
    min: function(t, e) {
        if (t[0] < e) {
            t[0] = e;
        }
        if (t[1] < e) {
            t[1] = e;
        }
        if (t[2] < e) {
            t[2] = e;
        }
        if (t[3] < e) {
            t[3] = e;
        }
        return this;
    },
    max: function(t, e) {
        if (t[0] > e) {
            t[0] = e;
        }
        if (t[1] > e) {
            t[1] = e;
        }
        if (t[2] > e) {
            t[2] = e;
        }
        if (t[3] > e) {
            t[3] = e;
        }
        return this;
    },
    clamp: function(t, e, i) {
        this.min(t, e);
        this.max(t, i);
        return this;
    },
};
FSS.Color = function(t, e) {
    this.rgba = FSS.Vector4.create();
    this.hex = t || '#000000';
    this.opacity = FSS.Utils.isNumber(e) ? e : 1;
    this.set(this.hex, this.opacity);
};
FSS.Color.prototype = {
    set: function(t, e) {
        t = t.replace('#', '');
        let i = t.length / 3;
        this.rgba[0] = parseInt(t.substring(i * 0, i * 1), 16) / 255;
        this.rgba[1] = parseInt(t.substring(i * 1, i * 2), 16) / 255;
        this.rgba[2] = parseInt(t.substring(i * 2, i * 3), 16) / 255;
        this.rgba[3] = FSS.Utils.isNumber(e) ? e : this.rgba[3];
        return this;
    },
    hexify: function(t) {
        let e = Math.ceil(t * 255).toString(16);
        if (e.length === 1) {
            e = '0' + e;
        }
        return e;
    },
    format: function() {
        let t = this.hexify(this.rgba[0]);
        let e = this.hexify(this.rgba[1]);
        let i = this.hexify(this.rgba[2]);
        this.hex = '#' + t + e + i;
        return this.hex;
    },
};
FSS.Object = function() {
    this.position = FSS.Vector3.create();
};
FSS.Object.prototype = {
    setPosition: function(t, e, i) {
        FSS.Vector3.set(this.position, t, e, i);
        return this;
    },
};
FSS.Light = function(t, e) {
    FSS.Object.call(this);
    this.ambient = new FSS.Color(t || '#FFFFFF');
    this.diffuse = new FSS.Color(e || '#FFFFFF');
    this.ray = FSS.Vector3.create();
};
FSS.Light.prototype = Object.create(FSS.Object.prototype);
FSS.Vertex = function(t, e, i) {
    this.position = FSS.Vector3.create(t, e, i);
};
FSS.Vertex.prototype = {
    setPosition: function(t, e, i) {
        FSS.Vector3.set(this.position, t, e, i);
        return this;
    },
};
FSS.Triangle = function(t, e, i) {
    this.a = t || new FSS.Vertex;
    this.b = e || new FSS.Vertex;
    this.c = i || new FSS.Vertex;
    this.vertices = [this.a, this.b, this.c];
    this.u = FSS.Vector3.create();
    this.v = FSS.Vector3.create();
    this.centroid = FSS.Vector3.create();
    this.normal = FSS.Vector3.create();
    this.color = new FSS.Color;
    this.polygon = document.createElementNS(FSS.SVGNS, 'polygon');
    this.polygon.setAttributeNS(null, 'stroke-linejoin', 'round');
    this.polygon.setAttributeNS(null, 'stroke-miterlimit', '1');
    this.polygon.setAttributeNS(null, 'stroke-width', '1');
    this.computeCentroid();
    this.computeNormal();
};
FSS.Triangle.prototype = {
    computeCentroid: function() {
        this.centroid[0] = this.a.position[0] + this.b.position[0] + this.c.position[0];
        this.centroid[1] = this.a.position[1] + this.b.position[1] + this.c.position[1];
        this.centroid[2] = this.a.position[2] + this.b.position[2] + this.c.position[2];
        FSS.Vector3.divideScalar(this.centroid, 3);
        return this;
    },
    computeNormal: function() {
        FSS.Vector3.subtractVectors(this.u, this.b.position, this.a.position);
        FSS.Vector3.subtractVectors(this.v, this.c.position, this.a.position);
        FSS.Vector3.crossVectors(this.normal, this.u, this.v);
        FSS.Vector3.normalise(this.normal);
        return this;
    },
};
FSS.Geometry = function() {
    this.vertices = [];
    this.triangles = [];
    this.dirty = false;
};
FSS.Geometry.prototype = {
    update: function() {
        if (this.dirty) {
            let t, e;
            for (t = this.triangles.length - 1; t >= 0; t--) {
                e = this.triangles[t];
                e.computeCentroid();
                e.computeNormal();
            }
            this.dirty = false;
        }
        return this;
    },
};
FSS.Plane = function(t, e, i, r) {
    FSS.Geometry.call(this);
    this.width = t || 100;
    this.height = e || 100;
    this.segments = i || 4;
    this.slices = r || 4;
    this.segmentWidth = this.width / this.segments;
    this.sliceHeight = this.height / this.slices;
    let s, n, o, h, a, l, u, c, f = [],
        S = this.width * -.5,
        p = this.height * .5;
    for (s = 0; s <= this.segments; s++) {
        f.push([]);
        for (n = 0; n <= this.slices; n++) {
            u = new FSS.Vertex(S + s * this.segmentWidth, p - n * this.sliceHeight);
            f[s].push(u);
            this.vertices.push(u);
        }
    }
    for (s = 0; s < this.segments; s++) {
        for (n = 0; n < this.slices; n++) {
            o = f[s + 0][n + 0];
            h = f[s + 0][n + 1];
            a = f[s + 1][n + 0];
            l = f[s + 1][n + 1];
            t0 = new FSS.Triangle(o, h, a);
            t1 = new FSS.Triangle(a, h, l);
            this.triangles.push(t0, t1);
        }
    }
};
FSS.Plane.prototype = Object.create(FSS.Geometry.prototype);
FSS.Material = function(t, e, i, r, s) {
    this.ambient = new FSS.Color(t || '#444444');
    this.diffuse = new FSS.Color(e || '#FFFFFF');
    this.strokeOpacity = r === undefined ? 1 : r;
    this.fillOpacity = i === undefined ? 1 : i;
    this.strokeWidth = s === undefined ? 1 : s;
    this.slave = new FSS.Color;
};
FSS.Mesh = function(t, e) {
    FSS.Object.call(this);
    this.geometry = t || new FSS.Geometry;
    this.material = e || new FSS.Material;
    this.side = FSS.FRONT;
    this.visible = true;
};
FSS.Mesh.prototype = Object.create(FSS.Object.prototype);
FSS.Mesh.prototype.update = function(t, e) {
    let i, r, s, n, o;
    this.geometry.update();
    if (e) {
        for (i = this.geometry.triangles.length - 1; i >= 0; i--) {
            r = this.geometry.triangles[i];
            FSS.Vector4.set(r.color.rgba);
            for (s = t.length - 1; s >= 0; s--) {
                n = t[s];
                FSS.Vector3.subtractVectors(n.ray, n.position, r.centroid);
                FSS.Vector3.normalise(n.ray);
                o = FSS.Vector3.dot(r.normal, n.ray);
                if (this.side === FSS.FRONT) {
                    o = Math.max(o, 0);
                } else if (this.side === FSS.BACK) {
                    o = Math.abs(Math.min(o, 0));
                } else if (this.side === FSS.DOUBLE) {
                    o = Math.max(Math.abs(o), 0);
                }
                FSS.Vector4.multiplyVectors(this.material.slave.rgba, this.material.ambient.rgba, n.ambient.rgba);
                FSS.Vector4.add(r.color.rgba, this.material.slave.rgba);
                FSS.Vector4.multiplyVectors(this.material.slave.rgba, this.material.diffuse.rgba, n.diffuse.rgba);
                FSS.Vector4.multiplyScalar(this.material.slave.rgba, o);
                FSS.Vector4.add(r.color.rgba, this.material.slave.rgba);
            }
            FSS.Vector4.clamp(r.color.rgba, 0, 1);
        }
    }
    return this;
};
FSS.Scene = function() {
    this.meshes = [];
    this.lights = [];
};
FSS.Scene.prototype = {
    add: function(t) {
        if (t instanceof FSS.Mesh && !~this.meshes.indexOf(t)) {
            this.meshes.push(t);
        } else if (t instanceof FSS.Light && !~this.lights.indexOf(t)) {
            this.lights.push(t);
        }
        return this;
    },
    remove: function(t) {
        if (t instanceof FSS.Mesh && ~this.meshes.indexOf(t)) {
            this.meshes.splice(this.meshes.indexOf(t), 1);
        } else if (t instanceof FSS.Light && ~this.lights.indexOf(t)) {
            this.lights.splice(this.lights.indexOf(t), 1);
        }
        return this;
    },
};
FSS.Renderer = function() {
    this.width = 0;
    this.height = 0;
    this.halfWidth = 0;
    this.halfHeight = 0;
};
FSS.Renderer.prototype = {
    setSize: function(t, e) {
        if (this.width === t && this.height === e) {
            return;
        }
        this.width = t;
        this.height = e;
        this.halfWidth = this.width * .5;
        this.halfHeight = this.height * .5;
        return this;
    },
    clear: function() {
        return this;
    },
    render: function(t) {
        return this;
    },
};
FSS.CanvasRenderer = function() {
    FSS.Renderer.call(this);
    this.element = document.createElement('canvas');
    this.element.style.display = 'block';
    this.context = this.element.getContext('2d');
    this.setSize(this.element.width, this.element.height);
};
FSS.CanvasRenderer.prototype = Object.create(FSS.Renderer.prototype);
FSS.CanvasRenderer.prototype.setSize = function(t, e) {
    FSS.Renderer.prototype.setSize.call(this, t, e);
    this.element.width = t;
    this.element.height = e;
    this.context.setTransform(1, 0, 0, -1, this.halfWidth, this.halfHeight);
    return this;
};
FSS.CanvasRenderer.prototype.clear = function() {
    FSS.Renderer.prototype.clear.call(this);
    this.context.clearRect(-this.halfWidth, -this.halfHeight, this.width, this.height);
    return this;
};
FSS.CanvasRenderer.prototype.render = function(t) {
    FSS.Renderer.prototype.render.call(this, t);
    let e, i, r, s, n;
    this.clear();
    this.context.lineJoin = 'round';
    for (e = t.meshes.length - 1; e >= 0; e--) {
        i = t.meshes[e];
        if (i.visible) {
            i.update(t.lights, true);
            this.context.lineWidth = i.material.strokeWidth;
            for (r = i.geometry.triangles.length - 1; r >= 0; r--) {
                s = i.geometry.triangles[r];
                n = s.color.format();
                this.context.beginPath();
                this.context.moveTo(s.a.position[0], s.a.position[1]);
                this.context.lineTo(s.b.position[0], s.b.position[1]);
                this.context.lineTo(s.c.position[0], s.c.position[1]);
                this.context.closePath();
                this.context.strokeStyle = n;
                this.context.fillStyle = n;
                this.context.globalAlpha = i.material.strokeOpacity;
                this.context.stroke();
                this.context.globalAlpha = i.material.fillOpacity;
                this.context.fill();
            }
        }
    }
    return this;
};
FSS.WebGLRenderer = function() {
    FSS.Renderer.call(this);
    this.element = document.createElement('canvas');
    this.element.style.display = 'block';
    this.vertices = null;
    this.lights = null;
    let t = {
        preserveDrawingBuffer: false,
        premultipliedAlpha: true,
        antialias: true,
        stencil: true,
        alpha: true,
    };
    this.gl = this.getContext(this.element, t);
    this.unsupported = !this.gl;
    if (this.unsupported) {
        return 'WebGL is not supported by your browser.';
    } else {
        this.gl.clearColor(0, 0, 0, 0);
        this.gl.enable(this.gl.DEPTH_TEST);
        this.setSize(this.element.width, this.element.height);
    }
};
FSS.WebGLRenderer.prototype = Object.create(FSS.Renderer.prototype);
FSS.WebGLRenderer.prototype.getContext = function(t, e) {
    let i = false;
    try {
        if (!(i = t.getContext('experimental-webgl', e))) {
            throw 'Error creating WebGL context.';
        }
    } catch (t) {
        console.error(t);
    }
    return i;
};
FSS.WebGLRenderer.prototype.setSize = function(t, e) {
    FSS.Renderer.prototype.setSize.call(this, t, e);
    if (this.unsupported) {
        return;
    }
    this.element.width = t;
    this.element.height = e;
    this.gl.viewport(0, 0, t, e);
    return this;
};
FSS.WebGLRenderer.prototype.clear = function() {
    FSS.Renderer.prototype.clear.call(this);
    if (this.unsupported) {
        return;
    }
    this.gl.clear(this.gl.COLOR_BUFFER_BIT | this.gl.DEPTH_BUFFER_BIT);
    return this;
};
FSS.WebGLRenderer.prototype.render = function(t) {
    FSS.Renderer.prototype.render.call(this, t);
    if (this.unsupported) {
        return;
    }
    let e, i, r, s, n, o, h, a, l, u, c, f, S = false,
        p = t.lights.length,
        d, m, g, F, b = 0;
    this.clear();
    if (this.lights !== p) {
        this.lights = p;
        if (this.lights > 0) {
            this.buildProgram(p);
        } else {
            return;
        }
    }
    if (!!this.program) {
        for (e = t.meshes.length - 1; e >= 0; e--) {
            i = t.meshes[e];
            if (i.geometry.dirty) {
                S = true;
            }
            i.update(t.lights, false);
            b += i.geometry.triangles.length * 3;
        }
        if (S || this.vertices !== b) {
            this.vertices = b;
            for (a in this.program.attributes) {
                u = this.program.attributes[a];
                u.data = new FSS.Array(b * u.size);
                d = 0;
                for (e = t.meshes.length - 1; e >= 0; e--) {
                    i = t.meshes[e];
                    for (r = 0,
                             s = i.geometry.triangles.length; r < s; r++) {
                        n = i.geometry.triangles[r];
                        for (m = 0,
                                 g = n.vertices.length; m < g; m++) {
                            vertex = n.vertices[m];
                            switch (a) {
                                case 'side':
                                    this.setBufferData(d, u, i.side);
                                    break;
                                case 'position':
                                    this.setBufferData(d, u, vertex.position);
                                    break;
                                case 'centroid':
                                    this.setBufferData(d, u, n.centroid);
                                    break;
                                case 'normal':
                                    this.setBufferData(d, u, n.normal);
                                    break;
                                case 'ambient':
                                    this.setBufferData(d, u, i.material.ambient.rgba);
                                    break;
                                case 'diffuse':
                                    this.setBufferData(d, u, i.material.diffuse.rgba);
                                    break;
                            }
                            d++;
                        }
                    }
                }
                this.gl.bindBuffer(this.gl.ARRAY_BUFFER, u.buffer);
                this.gl.bufferData(this.gl.ARRAY_BUFFER, u.data, this.gl.DYNAMIC_DRAW);
                this.gl.enableVertexAttribArray(u.location);
                this.gl.vertexAttribPointer(u.location, u.size, this.gl.FLOAT, false, 0, 0);
            }
        }
        this.setBufferData(0, this.program.uniforms.resolution, [this.width, this.height, this.width]);
        for (o = p - 1; o >= 0; o--) {
            h = t.lights[o];
            this.setBufferData(o, this.program.uniforms.lightPosition, h.position);
            this.setBufferData(o, this.program.uniforms.lightAmbient, h.ambient.rgba);
            this.setBufferData(o, this.program.uniforms.lightDiffuse, h.diffuse.rgba);
        }
        for (l in this.program.uniforms) {
            u = this.program.uniforms[l];
            f = u.location;
            c = u.data;
            switch (u.structure) {
                case '3f':
                    this.gl.uniform3f(f, c[0], c[1], c[2]);
                    break;
                case '3fv':
                    this.gl.uniform3fv(f, c);
                    break;
                case '4fv':
                    this.gl.uniform4fv(f, c);
                    break;
            }
        }
    }
    this.gl.drawArrays(this.gl.TRIANGLES, 0, this.vertices);
    return this;
};
FSS.WebGLRenderer.prototype.setBufferData = function(t, e, i) {
    if (FSS.Utils.isNumber(i)) {
        e.data[t * e.size] = i;
    } else {
        for (let r = i.length - 1; r >= 0; r--) {
            e.data[t * e.size + r] = i[r];
        }
    }
};
FSS.WebGLRenderer.prototype.buildProgram = function(t) {
    if (this.unsupported) {
        return;
    }
    let e = FSS.WebGLRenderer.VS(t);
    let i = FSS.WebGLRenderer.FS(t);
    let r = e + i;
    if (!!this.program && this.program.code === r) {
        return;
    }
    let s = this.gl.createProgram();
    let n = this.buildShader(this.gl.VERTEX_SHADER, e);
    let o = this.buildShader(this.gl.FRAGMENT_SHADER, i);
    this.gl.attachShader(s, n);
    this.gl.attachShader(s, o);
    this.gl.linkProgram(s);
    if (!this.gl.getProgramParameter(s, this.gl.LINK_STATUS)) {
        let h = this.gl.getError();
        let a = this.gl.getProgramParameter(s, this.gl.VALIDATE_STATUS);
        console.error('Could not initialise shader.\nVALIDATE_STATUS: ' + a + '\nERROR: ' + h);
        return null;
    }
    this.gl.deleteShader(o);
    this.gl.deleteShader(n);
    s.code = r;
    s.attributes = {
        side: this.buildBuffer(s, 'attribute', 'aSide', 1, 'f'),
        position: this.buildBuffer(s, 'attribute', 'aPosition', 3, 'v3'),
        centroid: this.buildBuffer(s, 'attribute', 'aCentroid', 3, 'v3'),
        normal: this.buildBuffer(s, 'attribute', 'aNormal', 3, 'v3'),
        ambient: this.buildBuffer(s, 'attribute', 'aAmbient', 4, 'v4'),
        diffuse: this.buildBuffer(s, 'attribute', 'aDiffuse', 4, 'v4'),
    };
    s.uniforms = {
        resolution: this.buildBuffer(s, 'uniform', 'uResolution', 3, '3f', 1),
        lightPosition: this.buildBuffer(s, 'uniform', 'uLightPosition', 3, '3fv', t),
        lightAmbient: this.buildBuffer(s, 'uniform', 'uLightAmbient', 4, '4fv', t),
        lightDiffuse: this.buildBuffer(s, 'uniform', 'uLightDiffuse', 4, '4fv', t),
    };
    this.program = s;
    this.gl.useProgram(this.program);
    return s;
};
FSS.WebGLRenderer.prototype.buildShader = function(t, e) {
    if (this.unsupported) {
        return;
    }
    let i = this.gl.createShader(t);
    this.gl.shaderSource(i, e);
    this.gl.compileShader(i);
    if (!this.gl.getShaderParameter(i, this.gl.COMPILE_STATUS)) {
        console.error(this.gl.getShaderInfoLog(i));
        return null;
    }
    return i;
};
FSS.WebGLRenderer.prototype.buildBuffer = function(t, e, i, r, s, n) {
    let o = {
        buffer: this.gl.createBuffer(),
        size: r,
        structure: s,
        data: null,
    };
    switch (e) {
        case 'attribute':
            o.location = this.gl.getAttribLocation(t, i);
            break;
        case 'uniform':
            o.location = this.gl.getUniformLocation(t, i);
            break;
    }
    if (!!n) {
        o.data = new FSS.Array(n * r);
    }
    return o;
};
FSS.WebGLRenderer.VS = function(t) {
    let e = ['precision mediump float;', '#define LIGHTS ' + t, 'attribute float aSide;',
        'attribute vec3 aPosition;', 'attribute vec3 aCentroid;', 'attribute vec3 aNormal;',
        'attribute vec4 aAmbient;', 'attribute vec4 aDiffuse;', 'uniform vec3 uResolution;',
        'uniform vec3 uLightPosition[LIGHTS];', 'uniform vec4 uLightAmbient[LIGHTS];',
        'uniform vec4 uLightDiffuse[LIGHTS];', 'varying vec4 vColor;', 'void main() {',
        'vColor = vec4(0.0);', 'vec3 position = aPosition / uResolution * 2.0;',
        'for (int i = 0; i < LIGHTS; i++) {', 'vec3 lightPosition = uLightPosition[i];',
        'vec4 lightAmbient = uLightAmbient[i];', 'vec4 lightDiffuse = uLightDiffuse[i];',
        'vec3 ray = normalize(lightPosition - aCentroid);', 'float illuminance = dot(aNormal, ray);',
        'if (aSide == 0.0) {', 'illuminance = max(illuminance, 0.0);', '} else if (aSide == 1.0) {',
        'illuminance = abs(min(illuminance, 0.0));', '} else if (aSide == 2.0) {',
        'illuminance = max(abs(illuminance), 0.0);', '}', 'vColor += aAmbient * lightAmbient;',
        'vColor += aDiffuse * lightDiffuse * illuminance;', '}', 'vColor = clamp(vColor, 0.0, 1.0);',
        'gl_Position = vec4(position, 1.0);', '}',
    ].join('\n');
    return e;
};
FSS.WebGLRenderer.FS = function(t) {
    let e = ['precision mediump float;', 'varying vec4 vColor;', 'void main() {', 'gl_FragColor = vColor;', '}']
        .join('\n');
    return e;
};
FSS.SVGRenderer = function() {
    FSS.Renderer.call(this);
    this.element = document.createElementNS(FSS.SVGNS, 'svg');
    this.element.setAttribute('xmlns', FSS.SVGNS);
    this.element.setAttribute('version', '1.1');
    this.element.style.display = 'block';
    this.setSize(300, 150);
};
FSS.SVGRenderer.prototype = Object.create(FSS.Renderer.prototype);
FSS.SVGRenderer.prototype.setSize = function(t, e) {
    FSS.Renderer.prototype.setSize.call(this, t, e);
    this.element.setAttribute('width', t);
    this.element.setAttribute('height', e);
    return this;
};
FSS.SVGRenderer.prototype.clear = function() {
    FSS.Renderer.prototype.clear.call(this);
    for (let t = this.element.childNodes.length - 1; t >= 0; t--) {
        this.element.removeChild(this.element.childNodes[t]);
    }
    return this;
};
FSS.SVGRenderer.prototype.render = function(t) {
    FSS.Renderer.prototype.render.call(this, t);
    let e, i, r, s, n, o;
    for (e = t.meshes.length - 1; e >= 0; e--) {
        i = t.meshes[e];
        if (i.visible) {
            i.update(t.lights, true);
            for (r = i.geometry.triangles.length - 1; r >= 0; r--) {
                s = i.geometry.triangles[r];
                if (s.polygon.parentNode !== this.element) {
                    this.element.appendChild(s.polygon);
                }
                n = this.formatPoint(s.a) + ' ';
                n += this.formatPoint(s.b) + ' ';
                n += this.formatPoint(s.c);
                o = this.formatStyle(s.color.format(), i.material.fillOpacity, i.material.strokeOpacity);
                s.polygon.setAttributeNS(null, 'points', n);
                s.polygon.setAttributeNS(null, 'style', o);
            }
        }
    }
    return this;
};
FSS.SVGRenderer.prototype.formatPoint = function(t) {
    return this.halfWidth + t.position[0] + ',' + (this.halfHeight - t.position[1]);
};
FSS.SVGRenderer.prototype.formatStyle = function(t, e, i) {
    let r = 'fill:' + t + ';';
    r += 'fill-opacity:' + e + ';';
    r += 'stroke:' + t + ';';
    r += 'stroke-opacity:' + i + ';';
    return r;
};
(function(t) {
    let e = function(t, e) {
        let i = {
                container: 'body',
                cellsize: 100,
                jitter: .33,
                depth: 20,
                depthTransform: null,
                materialAmbient: '#FFFFFF',
                materialDiffuse: '#FFFFFF',
                fillOpacity: 1,
                strokeOpacity: 1,
                strokeWidth: 1,
                renderWith: 'svg',
                renderCallback: function(t) {
                },
            },
            r, s = this;
        this.options = {};
        for (let n in i) {
            if (t.hasOwnProperty(n)) {
                this.options[n] = t[n];
            } else if (i.hasOwnProperty(n)) {
                this.options[n] = i[n];
            }
        }
        this.options.$container = document.querySelector(this.options.container);
        this.$wrapper = document.createElement('div');
        this.$wrapper.className += ' shadedSurfaceWrapper';
        let o = this.$wrapper.style;
        o.position = 'absolute';
        o.overflow = 'hidden';
        o.top = 0 + 'px';
        o.bottom = 0 + 'px';
        o.left = 0 + 'px';
        o.right = 0 + 'px';
        this.options.distortion = this.options.jitter * this.options.cellsize;
        this.options.$container.style.backgroundColor = '#000';
        r = {
            svg: FSS.SVGRenderer,
            canvas: FSS.CanvasRenderer,
            webgl: FSS.WebGLRenderer,
        }[this.options.renderWith];
        if (!r) {
            throw 'Undefined Renderer; aborting';
        }
        this.renderer = new r;
        this.scene = new FSS.Scene;
        this.lightDefs = e;
        return this;
    };
    t.ShadedSurface = e;
    e.prototype.initialize = function() {
        let e = this;
        this.scene.add(this.makeMesh());
        this.distortMesh(this.options.depthTransform);
        for (let i = 0; i < this.lightDefs.length; i++) {
            let r = this.lightDefs[i];
            e.scene.add(new FSS.Light(r.ambient, r.diffuse));
        }
        this.options.$container.appendChild(this.$wrapper);
        this.$wrapper.appendChild(this.renderer.element);
        if (t.getComputedStyle(this.options.$container).position === 'static') {
            this.options.$container.style.position = 'relative';
        }
        let s = this.renderer.element.style;
        s.position = 'absolute';
        s.top = -this.options.distortion + 'px';
        s.right = -this.options.distortion + 'px';
        s.bottom = -this.options.distortion + 'px';
        s.left = -this.options.distortion + 'px';
        let n = function(i) {
            t.requestAnimationFrame(function() {
                e.resize().draw();
            });
        };
        if (t.addEventListener) {
            t.addEventListener('resize', n);
        }
        return this;
    };
    e.prototype.resize = function() {
        this.scene.meshes[0] = this.makeMesh();
        this.distortMesh(this.options.depthTransform);
        this.renderer.setSize(this.options.$container.offsetWidth + 2 * this.options.distortion, this.options
            .$container.offsetHeight + 2 * this.options.distortion);
        return this;
    };
    e.prototype.makeMesh = function(t, e) {
        let i = this.options.$container.offsetWidth,
            r = this.options.$container.offsetHeight;
        if (!t) {
            t = new FSS.Plane(i + 2 * this.options.distortion, r + 2 * this.options.distortion, Math.floor(
                i / this.options.cellsize), Math.floor(r / this.options.cellsize));
        }
        if (!e) {
            e = new FSS.Material(this.options.materialAmbient, this.options.materialDiffuse, this.options.fillOpacity,
                this.options.strokeOpacity, this.options.strokeWidth);
        }
        return new FSS.Mesh(t, e);
    };
    e.prototype.distortMesh = function(t) {
        let e = this.scene.meshes[0],
            i, r, s = this.options.distortion,
            n = this.options.depth,
            o = t || function(t, e, i) {
                return Math.randomInRange(-i, i);
            };
        for (i = e.geometry.vertices.length - 1; i >= 0; i--) {
            r = e.geometry.vertices[i];
            r.position[0] = Math.round(r.position[0] + Math.randomInRange(-s, s));
            r.position[1] = Math.round(r.position[1] + Math.randomInRange(-s, s));
            r.position[2] = o(r.position[0], r.position[1], n);
        }
        e.geometry.dirty = true;
        return this;
    };
    e.prototype.draw = function() {
        var t = this,
            e, i = this.getWidth(),
            r = this.getHeight();

        function s(t) {
            if (typeof t === 'function') {
                return t(i, r);
            } else {
                return t;
            }
        }

        for (let n = 0; n < this.scene.lights.length; n++) {
            var e = this.lightDefs[n];
            t.scene.lights[n].setPosition(s(e.x), s(e.y), s(e.z));
        }
        this.renderer.render(this.scene);
        this.options.renderCallback(this);
        return this;
    };
    e.prototype.dark = function() {
        this.scene.meshes[0].material.ambient = new FSS.Color('#000000');
        this.scene.meshes[0].material.diffuse = new FSS.Color('#000000');
        this.renderer.render(this.scene);
        return this;
    };

    function i(t) {
        if (t <= 0) {
            return 0;
        }
        if (t >= 1) {
            return 1;
        }
        let e = t * t,
            i = e * t;
        return 4 * (t < .5 ? i : 3 * (t - e) + i - .75);
    }

    e.prototype.lightUp = function(e) {
        var r = this,
            s = r.getWidth(),
            n = r.getHeight(),
            e = Math.round(Number(e)) || 60,
            o = 0,
            h = i;

        function a(t) {
            if (typeof t === 'function') {
                return t(s, n);
            } else {
                return t;
            }
        }

        for (let l = 0; l < r.scene.lights.length; l++) {
            let u = r.scene.lights[l],
                c = r.lightDefs[l];
            if (c.start) {
                u.start = [a(c.start.x), a(c.start.y), a(c.start.z)];
            } else {
                u.start = [0, 0, 0];
            }
            u.diff = [u.position[0] - u.start[0], u.position[1] - u.start[1], u.position[2] - u.start[2]];
        }

        function f() {
            let i = h(o / e);
            for (let s = 0; s < r.scene.lights.length; s++) {
                let n = r.scene.lights[s];
                n.setPosition(n.start[0] + n.diff[0] * i, n.start[1] + n.diff[1] * i, n.start[2] + n.diff[2] *
                    i);
            }
            r.renderer.render(r.scene);
            if (o < e) {
                o++;
                t.requestAnimationFrame(f);
            }
        }

        r.scene.meshes[0].material.ambient = new FSS.Color(r.options.materialAmbient);
        r.scene.meshes[0].material.diffuse = new FSS.Color(r.options.materialDiffuse);
        f();
    };
    e.prototype.getHeight = function() {
        let t = this.scene.meshes[0];
        if (t) {
            return t.geometry.height;
        } else {
            return this.options.$container.offsetHeight;
        }
    };
    e.prototype.getWidth = function() {
        let t = this.scene.meshes[0];
        if (t) {
            return t.geometry.width;
        } else {
            return this.options.$container.offsetWidth;
        }
    };
})(this);

(function() {
    let height = 50,
        spotHeightCoef = 1.4;

    // Lights for the shader scene.
    // Coordinates are relative to center point.
    let loginLights = [{
        ambient: '#20292f',
        diffuse: '#e2b8e0',
        x: -240,
        y: function(w, h) {
            return h / 2 - 150;
        },
        z: function(w, h) {
            return height * w / 1300;
        },
        start: {
            x: function(w, h) {
                return -240;
            },
            y: function(w, h) {
                return -h / 2;
            },
            z: 0,
        },

    }, {
        // hilite
        ambient: '#000000',
        diffuse: '#ea3556',
        x: function(w, h) {
            return w / 2 - 10;
        },
        y: 0,
        z: function(w, h) {
            return height * spotHeightCoef * w / 1300;
        },
        start: {
            x: function(w, h) {
                return w / 2;
            },
            y: function(w, h) {
                return -h / 2;
            },
            z: 0,
        },
    }];

    let loginSurface = new ShadedSurface({
        container: '#fss-container',
        cellsize: 85,
        jitter: 0.6,
        depth: 5,
        materialAmbient: '#ad1457',
        materialDiffuse: '#f57c42',
        fillOpacity: 0.80,
        strokeOpacity: 0.5,
        strokeWidth: 1,
        renderWith: 'canvas',
    }, loginLights);

    loginSurface.initialize()
                .resize()
                .draw()
                .lightUp();
}());
